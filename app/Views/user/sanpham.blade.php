@extends('layouts.user')
@section('content')
    <div class="slider">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="?act=san-pham"><img src="{{ BASE_URL }}public/img/cellphonesbanner.jpg"
                            class="d-block w-100" alt="..."></a>

                </div>
                <div class="carousel-item">
                    <a href="?act=san-pham"><img src="{{ BASE_URL }}public/img/cellphonesbanner.jpg"
                            class="d-block w-100" alt="..."></a>

                </div>
                <div class="carousel-item">
                    <a href="?act=san-pham"><img src="{{ BASE_URL }}public/img/cellphonesbanner.jpg"
                            class="d-block w-100" alt="..."></a>

                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="row">
        <aside class="col-md-3">
            <div class="filter mt-3">
                <h5><i class="fa-solid fa-filter"></i>Lọc</h5>
            </div>
            <div class="mucgia mt-3 mt-3 border p-2 border-2 rounded">
                <div class="title-mucgia">
                    <h6>Mức giá</h6>
                </div>
                <div class="list-group p-2">
                    <input type="hidden" id="hidden_minimum_price" value="0">
                    <input type="hidden" id="hidden_maximum_price" value="50000000">
                    <p id="price_show">Từ: 1.000-50.000.000</p>
                    <div class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" id="price_range">
                    </div>
                </div>
            </div>
            <div class="danhmuc mt-3 border p-2 border-2 rounded">
                <div class="title-danhmuc">
                    <h6>Danh mục</h6>
                </div>

                <div class="row row-cols-2">
                    <!--  -->
                    <?php
                foreach ($danhmuc as $key => $value) {
                    if ($value['id_dm'] != 0) {
                ?>
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input common_selector brand" type="checkbox" name="danhmuc"
                                id="danhmuc" value="<?= $value['id_dm'] ?>">
                            <label class="form-check-label" for="danhmuc1"><?= $value['ten_dm'] ?></label>
                        </div>
                    </div>
                    <?php
                    }
                }
                ?>
                    <!--  -->

                </div>

            </div>
            <div class="top-5 mt-3 mt-3 border p-2 border-2 rounded">
                <div class="title-top-5">
                    <h6>Top 5 sản phẩm nhiều lượt xem nhất</h6>
                </div>
                <!-- 1 -->
                <?php
            foreach ($top_5 as $key => $value) {
            ?>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <a href="{{ route('chi_tiet_san_pham/' . $value['id_sp']) }}"><img
                                src="{{ BASE_URL }}public/uploads/<?= $value['hinh'] ?>" alt=""
                                style="width: 100%;"></a>
                    </div>
                    <div class="col-md-8 lh-sm">
                        <a href="{{ route('chi_tiet_san_pham/' . $value['id_sp'] . '/') }}">
                            <h6><?= $value['ten_sp'] ?></h6>
                        </a>
                        <p>Giá chỉ
                            <?= number_format(ceil($value['gia_goc'] - $value['gia_goc'] * ($value['giam_gia'] / 100))) ?>
                        </p>
                        <p>Số lượt xem: <?= $value['so_luot_xem'] ?></p>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        </aside>
        <article class="col-md-9 mt-3">
            <div class="tilte-product p-2">
                <?php
                if (isset($_GET['tim_kiem'])) {
                    echo '<h4>Sản phẩm có từ khóa "' . $_GET['tim_kiem'] . '"</h4>';
                } else {
                    echo '<h4>Tất cả sản phẩm</h4>';
                }
                ?>
            </div>
            <div class="control" style="display: flex; justify-content: end;">
                <select value="" class="" name="loc" id="loc">
                    <option value="">Sắp xếp theo</option>
                    <option value="thap-cao">Giá thấp - cao</option>
                    <option value="cao-thap">Giá cao - thấp</option>
                </select>
            </div>
            {{-- data --}}
            <div class="row ">
                <div class="product">
                    <div class="row row-cols-4 g-2 py-2 filter_data">
                        <!-- 2 -->
                        <?php
                    if (is_array($sanpham)) {
                        foreach ($sanpham as $key => $value) {
                    ?>
                        <div class="col">
                            <div class="card position-relative" style="width: 14rem; height: 420px;">
                                <img src="{{ BASE_URL }}public/uploads/<?= $value['hinh'] ?>" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $value['ten_sp'] ?></h5>
                                    <div class="d-flex gap-2">
                                        <p class="text-danger fw-bold">
                                            <?= number_format(ceil($value['gia_goc'] - $value['gia_goc'] * ($value['giam_gia'] / 100))) ?>
                                        </p>
                                        <span
                                            class="text-decoration-line-through"><?= number_format($value['gia_goc']) ?></span>
                                    </div>
                                    <p class="card-text " style="width = 100%; height = 50px;"><?= $value['mo_ta'] ?></p>
                                    <a href="{{ route('chi_tiet_san_pham/' . $value['id_sp'] . '/') }}"
                                        class="btn btn-primary position-absolute bottom-0 start-50 translate-middle-x"
                                        style="margin-bottom:20px;">Mua ngay</a>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    } else {
                        echo 'Không tìm thấy sản phẩm nào :(((';
                    }
                    ?>
                    </div>
                </div>
            </div>
            {{-- Phân trang --}}
            <div id="pagination" class="d-flex justify-content-center mt-3"></div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php
                    if ($pagepre >= 1) {
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="{{ route('san_pham/page/' . $pagepre . '/') }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    }
                    ?>

                    <?php
                    for ($i = $from; $i <= $to; $i++) {
                    ?>
                    <li class="page-item"><a class="page-link" href="{{ route('san_pham/page/' . $i) }}"><?= $i ?></a>
                    </li>
                    <?php } ?>
                    <?php
                    if ($pagenext <= $tongsotrang) {
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="{{ route('san_pham/page/' . $pagenext . '/') }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </nav>
        </article>
    </div>
    <script>
        $(document).ready(function() {
            function filter_data() {
                var action = 'fetch_data';
                var min_price = $('#hidden_minimum_price').val();
                var max_price = $('#hidden_maximum_price').val();
                var danh_muc = [];
                var sort = $("#loc").val(); // Lấy giá trị của select
                var page = getPageFromUrl();
                
                $(".common_selector.brand:checked").each(function() {
                    danh_muc.push($(this).val());
                });
                var filter = {
                    action: action,
                    min_price: min_price,
                    max_price: max_price,
                    danh_muc: danh_muc,
                    sort: sort,
                    page: page
                }

                $.ajax({
                    url: '{{ route('filter_product') }}', // File xử lý filter
                    method: "POST",
                    data: filter,
                    success: function(data) {
                        $('.filter_data').html(data);
                    }
                });
            }

            function getPageFromUrl() {
                const urlParts = window.location.pathname.split('/');
                const pageIndex = urlParts.indexOf('page');
                return (pageIndex !== -1 && urlParts[pageIndex + 1]) ? parseInt(urlParts[pageIndex + 1]) : 1;
            }
            // Bắt sự kiện khi thay đổi danh mục
            $(document).on("change", ".common_selector.brand", function() {
                filter_data();
            });

            // Bắt sự kiện khi thay đổi sắp xếp
            $(document).on("change", "#loc", function() {
                filter_data();
            });

            $("#price_range").slider({
                range: true,
                min: 1000,
                max: 50000000,
                values: [1000, 50000000],
                step: 10000,
                stop: function(event, ui) {
                    $('#price_show').html("Từ: " + formatCurrency(ui.values[0]) + " - " +
                        formatCurrency(ui.values[1]));
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                    filter_data();
                }
            });

            function formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN').format(amount);
            }

        });
    </script>
@endsection
