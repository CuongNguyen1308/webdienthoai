@extends('layouts.user')
@section('content')
<div class="slider">
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="?act=san-pham"><img src="{{BASE_URL}}public/img/cellphonesbanner.jpg" class="d-block w-100" alt="..."></a>

            </div>
            <div class="carousel-item">
                <a href="?act=san-pham"><img src="{{BASE_URL}}public/img/cellphonesbanner.jpg" class="d-block w-100" alt="..."></a>

            </div>
            <div class="carousel-item">
                <a href="?act=san-pham"><img src="{{BASE_URL}}public/img/cellphonesbanner.jpg" class="d-block w-100" alt="..."></a>

            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
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
                <p id="price_show">Từ: 1000-50000000</p>
                <div class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" id="price_range"></div>
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
                                <input class="form-check-input common_selector brand" type="checkbox" name="danhmuc" id="danhmuc" value="<?= $value['id_dm'] ?>">
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
                        <a href="{{route("chi_tiet_san_pham/".$value['id_sp'])}}"><img src="{{BASE_URL}}public/uploads/<?= $value['hinh'] ?>" alt="" style="width: 100%;"></a>
                    </div>
                    <div class="col-md-8 lh-sm">
                        <a href="{{route("chi_tiet_san_pham/".$value['id_sp']."/")}}">
                            <h6><?= $value['ten_sp'] ?></h6>
                        </a>
                        <p>Giá chỉ <?= number_format(ceil($value['gia_goc'] - $value['gia_goc'] * ($value['giam_gia'] / 100))) ?></p>
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
            if (isset($_POST['tim_kiem'])) {
                echo '<h4>Sản phẩm có từ khóa "' . $_POST['tim_kiem'] . '"</h4>';
            } else {
                echo '<h4>Tất cả sản phẩm</h4>';
            }
            ?>
        </div>
        <div class="control" style="display: flex; justify-content: end;">
            <form action="" id="" name="" method="post">
                <select value="" class="" name="loc" id="loc">
                    <option value="">Sắp xếp theo</option>
                    <option value="thap-cao" <?php
                                                if (isset($_POST['loc'])) {
                                                    if ($_POST['loc'] == 'thap-cao') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>>Giá thấp - cao</option>
                    <option value="cao-thap" <?php
                                                if (isset($_POST['loc'])) {
                                                    if ($_POST['loc'] == 'cao-thap') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>>Giá cao - thấp</option>
                </select>
            </form>
        </div>
        <div class="row filter_data">
            <div class="product">
                <div class="row row-cols-4 g-2 py-2">
                    <!-- 2 -->
                    <?php
                    if (is_array($sanpham)) {
                        foreach ($sanpham as $key => $value) {
                    ?>
                            <div class="col">
                                <div class="card position-relative" style="width: 14rem; height: 420px;">
                                    <img src="{{BASE_URL}}public/uploads/<?= $value['hinh'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $value['ten_sp'] ?></h5>
                                        <div class="d-flex gap-2">
                                            <p class="text-danger fw-bold"><?= number_format(ceil($value['gia_goc'] - $value['gia_goc'] * ($value['giam_gia'] / 100))) ?></p>
                                            <span class="text-decoration-line-through"><?= number_format($value['gia_goc']) ?></span>
                                        </div>
                                        <p class="card-text " style="width = 100%; height = 50px;"><?= $value['mo_ta'] ?></p>
                                        <a href="{{route("chi_tiet_san_pham/".$value['id_sp']."/")}}" class="btn btn-primary position-absolute bottom-0 start-50 translate-middle-x" style="margin-bottom:20px;">Mua ngay</a>
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
        <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php
                    if ($pagepre >= 1) {
                    ?>
                        <li class="page-item">
                            <a class="page-link" href="{{route('san_pham/page/'.$pagepre."/")}}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    for ($i = $from; $i <= $to; $i++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="{{route('san_pham/page/'.$i)}}"><?= $i ?></a></li>
                    <?php } ?>
                    <?php
                    if ($pagenext <= $tongsotrang) {
                    ?>
                        <li class="page-item">
                            <a class="page-link" href="{{route('san_pham/page/'.$pagenext."/")}}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
    </article>
</div>
@endsection