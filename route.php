<?php

/**Điều hướng website */

use App\Controllers\Admin\AccountController;
use App\Controllers\Admin\BillController;
use Phroute\Phroute\RouteCollector;
use App\Controllers\User\ProductController as UserController;
use App\Controllers\Admin\ProductController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\CommentController;
use App\Controllers\Admin\StatisticalController;
use App\Controllers\User\AjaxController;
use App\Controllers\User\CartController;

$url = isset($_GET['url']) ? $_GET['url'] : '/';
$router = new RouteCollector();

/**
 * cú pháp:
 * $router->requestMethod($route, $handler);
 * - Request method: 
 *     + get: kéo dữ liệu về (danh sách sp/chi tiết sp)
 *     + post: đẩy dữ liệu lên sv (thêm mới bản ghi/update dữ liệu)
 *     + delete: gửi request xoá dữ liệu
 *     + any: 
 * 
 * - $route: '/', '/products'
 * - $handler: hàm xử lý logic
 *      + C1: viết trực tiếp code logic
 *      + C2: điều hướng đến file controller tương ứng
 *          $handler = [Namespace\TenClass::class,'tenFunction'];
 */

//khởi tạo filter để kiểm tra đăng nhập cho 1 số route nhất định
$router->filter('auth', function () {
    if (!isset($_SESSION['user'])) {
        header('location:'.route("dang_nhap"));
        return false;
    }
});
// $router->get('products', [ProductController::class, 'getAllProduct']);    # match only get requests
// $router->get('user-products', [UserController::class, 'getAllProduct']);

// $router->get('products/{id}/edit', [ProductController::class, 'edit']); // đưa người dùng vào trang sửa sản phẩm
// $router->post('products/{id}/update', [ProductController::class, 'update']); // cập nhật dữ liệu vào database
// $router->get('products/{id}/delete', [ProductController::class, 'delete']); // cập nhật dữ liệu vào database

/** Route group 
 * prefix group: đặt tiền tố chung cho 1 nhóm các route
 * filter group: filter cho cả group, các route con cũng sẽ đc áp dụng filter
 */
$router->get('',[UserController::class,"trang_chu"]);
$router->get('dang_nhap',[UserController::class,"login"]);
$router->post('dang_nhap',[UserController::class,"checklogin"]);

$router->get('dang_ky',[UserController::class,"register"]);
$router->post('dang_ky',[UserController::class,"checkregister"]);

$router->get('acount',[UserController::class,"acount"]);
$router->post('acount',[UserController::class,"logout"]);
$router->get('chi_tiet_san_pham/{id_sp}/',[UserController::class,"chi_tiet_san_pham"]);
$router->post('chi_tiet_san_pham/{id_sp}/',[UserController::class,"gui_du_lieu"]);

$router->get('gio_hang',[CartController::class,"gio_hang"]);
$router->post('gio_hang',[CartController::class,"checkout"]);
$router->post('add_cart',[AjaxController::class,"add_cart"]);
$router->post('updateQuantity',[AjaxController::class,"updateQuantity"]);
$router->post('updateVariant',[AjaxController::class,"updateVariant"]);
$router->get('gio_hang/{id}/delete', [CartController::class,'delete']);

$router->get('dat_hang',[UserController::class,"view_thong_tin"]);
$router->post('dat_hang',[UserController::class,"dat_hang"]);

$router->get('dat_hang_ngay',[UserController::class,"dat_ngay"]);
$router->post('dat_hang_ngay',[UserController::class,"dat_hang_ngay"]);

$router->get('don_hang',[UserController::class,'don_hang']);
$router->get('don_hang/{id_hd}',[UserController::class,'chi_tiet_don_hang']);
$router->get('don_hang/{id}/huydon', [UserController::class,'huydon']);
$router->get('don_hang/{id}/xacnhan', [UserController::class,'xacnhan']);

$router->get('san_pham',[UserController::class,"san_pham"]);
$router->get('san_pham/page/{page}/',[UserController::class,"phan_trang"]);
$router->get('san_pham/{id_dm}/',[UserController::class,"danh_muc"]);

$router->post('filter_product',[AjaxController::class,'filter']);

$router->group(['before' => 'auth', 'prefix' => '/admin'], function ($router) {
    $router->get('/',[ProductController::class, "san_pham"]);

    $router->get('/danh_muc', [CategoryController::class,'danh_muc']);
    $router->get('/danh_muc/add', [CategoryController::class,'add']);
    $router->post('/danh_muc/add', [CategoryController::class,'create']);
    $router->get('/danh_muc/{id}/edit', [CategoryController::class,'edit']);
    $router->post('/danh_muc/{id}/edit', [CategoryController::class,'update']);
    $router->get('/danh_muc/{id}/delete', [CategoryController::class,'delete']);

    $router->get('/san_pham', [ProductController::class, 'san_pham']);
    $router->get('san_pham/page/{page}/',[ProductController::class,"san_pham"]);
    $router->get('/san_pham/add_sp', [ProductController::class, 'add_sp']); // đưa người dùng vào trang sửa sản phẩm
    $router->post('/san_pham/add_sp', [ProductController::class, 'create_sp']); // đưa người dùng vào trang sửa sản phẩm
    $router->get('/san_pham/{id_sp}/edit_sp', [ProductController::class, 'edit_sp']); // đưa người dùng vào trang sửa sản phẩm
    $router->post('/san_pham/{id_sp}/edit_sp', [ProductController::class, 'update_sp']); // cập nhật dữ liệu vào database
    $router->get('/san_pham/{id_sp}/delete_sp', [ProductController::class, 'delete_sp']); // cập nhật dữ liệu vào database

    $router->get('/chi_tiet_san_pham/{id_sp}/san_pham',[ProductController::class,'ctsp']);
    $router->get('/chi_tiet_san_pham/{id_sp}/add', [ProductController::class, 'add_ctsp']); 
    $router->post('/chi_tiet_san_pham/{id_sp}/add', [ProductController::class, 'create_ctsp']); 
    $router->get('/chi_tiet_san_pham/{id_sp}/edit', [ProductController::class, 'edit_ctsp']); 
    $router->post('/chi_tiet_san_pham/{id_sp}/edit', [ProductController::class, 'update_ctsp']); 
    $router->get('/chi_tiet_san_pham/{id}/delete', [ProductController::class, 'delete_ctsp']); 

    $router->get('/tai_khoan', [AccountController::class,'list']);
    $router->get('/tai_khoan/add', [AccountController::class,'']);
    $router->get('/tai_khoan/{id_dm}/edit', [AccountController::class,'']);
    $router->post('/tai_khoan/{id_dm}/update', [AccountController::class,'']);
    $router->get('/tai_khoan/{id_dm}/delete', [AccountController::class,'']);

    $router->get('/binh_luan', [CommentController::class,'list']);
    $router->get('/binh_luan/{id_sp}', [CommentController::class,'list_bl']);
    $router->get('/binh_luan/{id}/delete', [CommentController::class,'delete']);

    $router->get('/don_hang', [BillController::class,'hoa_don']);
    $router->get('don_hang/page/{page}/',[BillController::class,"hoa_don"]);
    $router->get('/don_hang/{id_hd}', [BillController::class,'cthd']);
    $router->get('/don_hang/{id_hd}/edit', [BillController::class,'edit']);
    $router->post('/don_hang/{id_hd}/edit', [BillController::class,'update']);

    $router->get('/thong_ke',[StatisticalController::class,'thong_ke']);
});

// get: trả về giao diện thêm mới sản phẩm
// post: đẩy dữ liệu lên server
$router->get('create-product', function () {
    echo "Đây là trang thêm mới sản phẩm";
});
$router->post('save-product', function () {
    echo "Đây là trang thêm mới sản phẩm thành công";
});
// $router->get('/admin/users', function () {
//     echo "Đây là trang quản lý user";
// });
// $router->get('/admin/products', function () {
//     echo "Đây là trang quản lý product";
// });
// $router->get('/admin/categories', function () {
//     echo "Đây là trang quản lý category";
// });


$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);
