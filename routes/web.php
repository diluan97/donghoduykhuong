<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/// tk : testTMDT2020@gmail.com
// mk : lu

///Client
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','Guest\HomeController@home')->name('home');
Route::get('/chi-tiet-san-pham/{id}','Guest\ProductController@detail_product')->name('detail');
Route::get('/chi-tiet-gio-hang','Guest\CartController@cart_detail')->name('cart');
Route::post('/add-cart','Guest\CartController@purchaseCart')->name('add_cart');
Route::get('/thanh-toan','Guest\CartController@checkOut')->name('check_out');
Route::post('/cam-on','Guest\CartController@postCheckOut')->name('thanh_toan');
Route::get('/lich-su-mua-hang','Guest\HistoryOrderController@getHistoryOrder')->name('history_order');
Route::get('/tim-kiem','Guest\SearchController@getSearch')->name('search');
Route::get('/xoa-gio-hang','Guest\CartController@delCart')->name('delete_cart');
Route::post('/binh-luan','Guest\CommentController@postComment')->name('comment');
Route::post('/lien-he','Guest\ContactController@postContract')->name('contact');
Route::get('/lien-he','Guest\ContactController@getContact')->name('getcontact');
Route::post('/chinh-sua/{id}','Guest\CommentController@editComment')->name('edit_comment');
Route::post('/xoa-comment/{id}','Guest\CommentController@delComment')->name('delete_comment');
Route::post('/thay-doi-thong-tin/{id}','Guest\HomeController@editUser')->name('edit_user');
Route::get('/dang-nhap','Guest\HomeController@loginUser')->name('login_user');
Route::get('/chinh-sach','Guest\HomeController@policy')->name('policy');

Route::get('/thanh-toan-pay-pal','Guest\PayMentController@getPayPal')->name('getPayPal');
Route::post('paypal','Guest\PayMentController@payPayPal')->name('postPayPal');
Route::get('status','Guest\PayMentController@getPayMentStatus')->name('getStatus');

// Đăng nhập của khánh hàng
Route::post('/dang-nhap','Guest\LoginController@getLogin')->name('login_client');
Route::post('/dang-ky','Guest\LoginController@getRegister')->name('register_client');
Route::post('edit-user-{id}','Guest\LoginController@postUser')->name('edit_user');



//Admin
Route::get('admin','Admin\LoginAdminController@getLogin')->name('login');
Route::post('admin','Admin\LoginAdminController@postLogin')->name('post_login');
Route::get('admin-logout','Admin\LoginAdminController@getLogout')->name('logout');

Route::group(['prefix' => 'admin','middleware'=>['auth','Admin']],function(){
    Route::get('drashs' , 'Admin\DrashController@getDrash')->name('admin_drash');
    Route::resource('categories','Admin\CategoryController')->names('admin_category');
    Route::resource('products','Admin\ProductController')->names('admin_product');
    Route::resource('slides','Admin\SlideController')->names('admin_slide');
    Route::resource('orders','Admin\OrderController')->names('admin_order');
    Route::get('search-product','Admin\ProductController@searchProduct')->name('search_product');
    Route::resource('comment','Admin\CommentController')->names('admin_comment');
    Route::get('search-order','Admin\OrderController@searchOrder')->name('search_order');
    Route::resource('users','Admin\AdminController')->names('user');
    Route::resource('contact','Admin\ContactController')->names('admin_contact');
    Route::post('edit-contact/{id}','Admin\ContactController@editContact')->name('edit_contact');
});

