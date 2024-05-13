<div class="product">
    <div class="row row-cols-4 g-2 py-2">
        <!-- 2 -->
        <?php
        if (is_array($sanpham)) {
            foreach ($sanpham as $key => $value) {
        ?>
                <div class="col">
                    <div class="card position-relative" style="width: 14rem; height: 420px;">
                        <img src="uploads/<?= $value['hinh'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $value['ten_sp'] ?></h5>
                            <div class="d-flex gap-2">
                                <p class="text-danger fw-bold"><?= number_format(ceil($value['gia_goc'] - $value['gia_goc'] * ($value['giam_gia'] / 100))) ?></p>
                                <span class="text-decoration-line-through"><?= number_format($value['gia_goc']) ?></span>
                            </div>
                            <p class="card-text " style="width = 100%; height = 50px;"><?= $value['mo_ta'] ?></p>
                            <a href="?act=chi-tiet-san-pham&id_sp=<?= $value['id_sp'] ?>" class="btn btn-primary position-absolute bottom-0 start-50 translate-middle-x" style="margin-bottom:20px;">Mua ngay</a>
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

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php
            if ($pagepre >= 1) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="?act=san-pham&page=<?= $pagepre ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php
            }
            ?>

            <?php
            for ($i = $from; $i <= $to; $i++) {
            ?>
                <li class="page-item"><a class="page-link" href="?act=san-pham&page=<?= $i ?>"><?= $i ?></a></li>
            <?php } ?>
            <?php
            if ($pagenext <= $tongsotrang) {
            ?>
                <li class="page-item">
                    <a class="page-link" href="?act=san-pham&page=<?= $pagenext ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>