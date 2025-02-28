@extends('layouts.user')
@section('content')
    @if (isset($_SESSION['success_message']))
        <div class="alert alert-success">
            {{ $_SESSION['success_message'] }}
        </div>
        @php unset($_SESSION['success_message']); @endphp
    @endif
    <a href="{{ route('san_pham') }}"> <i class="fa-solid fa-arrow-left"></i> Tiếp tục mua sắm</a>
    <h5>Đơn hàng của bạn</h5>

    <div class="cart-items">
        @if (isset($items))
            <form action="{{ route('cart.updateAll') }}" method="POST">
                @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <!-- Checkbox ở đầu để chọn tất cả sản phẩm -->
                                <input type="checkbox" id="selectAll" onclick="toggleSelectAll()">
                            </th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Loại</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $tong = 0;
                        @endphp
                        @foreach ($items as $item)
                            @php
                                $gia_ban = $item['gia_goc'] - ($item['gia_goc'] * $item['giam_gia']) / 100;
                                $tong += $item['so_luong'] * $gia_ban;
                            @endphp
                            <tr>
                                <td>
                                    <!-- Checkbox cho từng sản phẩm -->
                                    <input type="checkbox" name="selected_items[]" value="{{ $item['id_ctsp'] }}"
                                        class="product-checkbox">
                                </td>
                                <td><img src="{{ BASE_URL }}public/uploads/<?= $item['hinh'] ?>"
                                        alt="{{ $item['ten_sp'] }}" style="width: 100px;"></td>
                                <td><a href="{{ route('chi_tiet_san_pham/' . $item['id_sp']) }}">{{ $item['ten_sp'] }}</a>
                                </td>
                                <td>
                                    <select name="variant_{{ $item['id_ctsp'] }}" class="form-control">
                                        @foreach ($item['ctsp'] as $variant)
                                            <option value="{{ $variant['id_ctsp'] }}"
                                                data-max-quantity="{{ $variant['so_luong'] }}"
                                                @if ($variant['id_ctsp'] == $item['id_ctsp']) selected @endif>
                                                {{ $variant['mau_sac'] . '-' . $variant['dung_luong'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{{ number_format($gia_ban) }} <small><s>{{ $item['gia_goc'] }}</s></small></td>
                                <td>
                                    <div class="cart-item" data-product-id="{{ $item['id_ctsp'] }}">
                                        <div class="input-group mb-3" style="width: 200px;">
                                            <button class="btn btn-outline-secondary decrease" type="button"
                                                data-product-id="{{ $item['id_ctsp'] }}">-</button>
                                            <input type="number" class="form-control text-center quantity"
                                                data-id-gh="{{ $item['id_gh'] }}"  
                                                data-product-id="{{ $item['id_ctsp'] }}" 
                                                value="{{ $item['so_luong'] }}"
                                                min="1" style="width: 60px;">
                                            <button class="btn btn-outline-secondary increase" type="button"
                                                data-product-id="{{ $item['id_ctsp'] }}">+</button>
                                        </div>
                                    </div>

                                </td>

                                <td>{{ number_format($item['so_luong'] * $gia_ban) }} </td>
                                <td>
                                    <a href="{{ route('gio_hang/' . $item['id_gh'] . '/delete') }}" class="btn btn-danger"
                                        onclick="return confirm('Bạn có muốn xóa không?')">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>

                            <td colspan="6">
                                <b>Tổng tiền</b>
                            </td>
                            <td colspan="2">
                                <b> {{ number_format($tong) }}</b>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="cart-total d-flex justify-content-end">
                    <div class="">
                        <button class="btn btn-primary">Thanh toán</button>
                    </div>
                </div>
            </form>
        @else
            <p>Giỏ hàng của bạn hiện đang trống.</p>
        @endif
    </div>
    <script>
        // Hàm chọn/deselect tất cả sản phẩm
        function toggleSelectAll() {
            var isChecked = document.getElementById('selectAll').checked;
            var checkboxes = document.querySelectorAll('.product-checkbox');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        }
        document.querySelectorAll('.increase').forEach(button => {
            button.addEventListener('click', function() {
                var productId = this.getAttribute('data-product-id');
                var quantityInput = document.querySelector(`.quantity[data-product-id="${productId}"]`);
                var selectedVariant = document.querySelector(
                    `select[name="variant_${productId}"] option:checked`);
                var maxQuantity = parseInt(selectedVariant.getAttribute(
                    'data-max-quantity')); // Lấy số lượng tối đa

                var currentQuantity = parseInt(quantityInput.value);
                if (currentQuantity < maxQuantity) {
                    quantityInput.value = currentQuantity + 1;
                } else {
                    alert('Số lượng đã đạt giới hạn tối đa!');
                }
            });
        });

        document.querySelectorAll('.decrease').forEach(button => {
            button.addEventListener('click', function() {
                var productId = this.getAttribute('data-product-id');
                var quantityInput = document.querySelector(`.quantity[data-product-id="${productId}"]`);
                if (parseInt(quantityInput.value) > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                }
            });
        });
        $('.increase, .decrease').on('click', function() {
            var id_ctsp = this.getAttribute('data-product-id');
            var so_luong = $('input.quantity[data-product-id="' + id_ctsp + '"]').val();
            var id_gh = $('input.quantity[data-product-id="' + id_ctsp + '"]').attr('data-id-gh');
            
            $.ajax({
                url: '{{ route('updateQuantity') }}', // URL của route xử lý tăng giảm số lượng
                type: 'POST',
                data: {
                    id_gh: id_gh,
                    id_ctsp: id_ctsp,
                    so_luong: so_luong
                },
                success: function(response) {
                    location.reload(); // Reload trang sau khi cập nhật thành công

                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                    alert('Có lỗi xảy ra!');
                }
            });
        });
    </script>
@endsection
