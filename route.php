<?php

/**Điều hướng website */

use Phroute\Phroute\RouteCollector;
use App\Controllers\User\ProductController as UserController;
use App\Controllers\Admin\ProductController;

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
        header('location:'.route("login"));
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
$router->get('login',[UserController::class,"login"]);
$router->post('login',[UserController::class,"checklogin"]);
$router->get('acount',[UserController::class,"acount"]);
$router->post('acount',[UserController::class,"logout"]);
$router->get('san_pham',[UserController::class,"san_pham"]);
$router->get('chi_tiet_san_pham/{id_sp}/',[UserController::class,"chi_tiet_san_pham"]);
$router->post('chi_tiet_san_pham/{id_sp}/',[UserController::class,"mua_sp"]);
$router->get('chi_tiet_san_pham/{id_sp}/{id_ctsp}',[UserController::class,"chi_tiet_san_pham_cau_hinh"]);
$router->post('chi_tiet_san_pham/{id_sp}/{id_ctsp}',[UserController::class,"mua_san_pham"]);
$router->get('dat_hang',[UserController::class,"view_thong_tin"]);
$router->post('dat_hang',[UserController::class,"dat_hang"]);
$router->get('don_hang',[UserController::class,'don_hang']);
$router->get('san_pham/page/{page}/',[UserController::class,"phan_trang"]);
$router->group(['before' => 'auth', 'prefix' => '/admin'], function ($router) {
    $router->get('/',[ProductController::class, "san_pham"]);
    $router->get('/danh_muc', [ProductController::class,'danh_muc']);
    $router->get('/danh_muc/add_dm', [ProductController::class,'']);
    $router->get('/danh_muc/{id_dm}/edit_dm', [ProductController::class,'']);
    $router->post('/danh_muc/{id_dm}/update_dm', [ProductController::class,'']);
    $router->get('/danh_muc/{id_dm}/delete_dm', [ProductController::class,'']);

    $router->get('/san_pham', [ProductController::class, 'san_pham']);
    $router->get('/san_pham/add_sp', [ProductController::class, 'add_sp']); // đưa người dùng vào trang sửa sản phẩm
    $router->post('/san_pham/add_sp', [ProductController::class, 'create_sp']); // đưa người dùng vào trang sửa sản phẩm
    $router->get('/san_pham/{id_sp}/edit_sp', [ProductController::class, 'edit_sp']); // đưa người dùng vào trang sửa sản phẩm
    $router->post('/san_pham/{id_sp}/edit_sp', [ProductController::class, 'update_sp']); // cập nhật dữ liệu vào database
    $router->get('/san_pham/{id_sp}/delete_sp', [ProductController::class, 'delete_sp']); // cập nhật dữ liệu vào database

    $router->get('/tai_khoan', function () {
        echo "Đây là trang quản lý category";
    });
    $router->get('/binh_luan', function () {
        echo "Đây là trang quản lý category";
    });
    $router->get('/don_hang', [ProductController::class,'hoa_don']);
    $router->get('/don_hang/{id_hd}', [ProductController::class,'cthd']);
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
