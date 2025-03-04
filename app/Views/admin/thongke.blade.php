@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <form method="GET" action="">
            <label for="yearSelect">Chọn năm:</label>
            <select name="year" id="yearSelect" class="form-select w-25">
                <?php 
                    $currentYear = date("Y");
                    for ($i = $currentYear; $i >= $currentYear - 4; $i--): 
                ?>
                <option value="<?= $i ?>" <?= isset($_GET['year']) && $_GET['year'] == $i ? 'selected' : '' ?>>
                    <?= $i ?>
                </option>
                <?php endfor; ?>
            </select>
            <button type="submit" class="btn btn-primary mt-2">Xem thống kê</button>
        </form>

        <h2 class="text-center mb-4">Thống kê đơn hàng - Năm <?= isset($_GET['year']) ? $_GET['year'] : date('Y') ?></h2>

        <!-- Thống kê tổng quan -->
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card shadow p-3">
                    <h5 class="card-title">Tổng đơn hàng</h5>
                    <p class="display-6 text-primary"><?= $thongke_tong['tongdonhang'] ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow p-3">
                    <h5 class="card-title">Tổng doanh thu</h5>
                    <p class="display-6 text-success"><?= number_format($thongke_tong['tongdoanhthu']) ?> </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow p-3">
                    <h5 class="card-title">Tổng sản phẩm bán</h5>
                    <p class="display-6 text-danger"><?= $thongke_tong['tongspban'] ?></p>
                </div>
            </div>
        </div>

        <div class="card shadow mt-4">
            <div class="card-body">
                <h5 class="card-title">Doanh thu & Số đơn hàng theo tháng (Năm <?= isset($_GET['year']) ? $_GET['year'] : date('Y') ?>)</h5>
                <canvas id="doanhthuChart"></canvas>
            </div>
        </div>





    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let data = <?= json_encode($thongke_theothang) ?>;

            // Tạo mảng 12 tháng
            let labels = Array.from({
                length: 12
            }, (_, i) => `Tháng ${i + 1}`);

            // Mảng chứa số lượng đơn hàng & doanh thu, mặc định là 0
            let orderData = new Array(12).fill(0);
            let revenueData = new Array(12).fill(0);

            // Gán dữ liệu vào tháng tương ứng
            data.forEach(item => {
                let monthIndex = item.thang_dat - 1;
                orderData[monthIndex] = item.so_luong_ban;
                revenueData[monthIndex] = item.doanh_thu;
            });

            // Vẽ biểu đồ
            const ctx = document.getElementById('doanhthuChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Doanh thu (VNĐ)',
                            data: revenueData,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            yAxisID: 'y1'
                        },
                        {
                            label: 'Số đơn hàng',
                            data: orderData,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            type: 'line',
                            yAxisID: 'y2'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y1: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Doanh thu (VNĐ)'
                            },
                            ticks: {
                                callback: (value) => value.toLocaleString() + " đ"
                            }
                        },
                        y2: {
                            type: 'linear',
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Số đơn hàng'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
