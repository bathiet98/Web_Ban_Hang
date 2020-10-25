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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['namespace' => 'Auth', 'prefix' => 'account'], function (){
   Route::get('register','RegisterController@getFormRegister')->name('get.register');
   Route::post('register','RegisterController@postRegister');

   Route::get('login','LoginController@getFromLogin')->name('get.login');
   Route::post('login','LoginController@postLogin');
   Route::get('logout','LoginController@getLogout')->name('get.logout');

});

Route::group(['namespace' => 'Frontend'], function (){
   Route::get('', 'HomeController@index')->name('get.home');

   Route::get('san-pham','ProductController@index')->name('get.product.list');
   Route::get('danh-muc/{slug}','CategoryController@index')->name('get.category.list');
   Route::get('san-pham/{slug}','ProductDetailController@getProductDetail')->name('get.product.detail');

   //Route bài viết
    Route::get('bai-viet','BlogController@index')->name('get.blog.list');
    //Route chi tiết bài viết
    Route::get('bai-viet/{slug}','ArticleDetailController@index')->name('get.article.detail');

   //Route Giỏ Hàng
   Route::get('don-hang','ShoppingCartController@index')->name('get.shopping.list');
   Route::group(['prefix'=>'shopping'], function (){
        Route::get('add/{id}','ShoppingCartController@add')->name('get.shopping.add');
        Route::get('mua-ngay/{id}','ShoppingCartController@buynow')->name('get.shopping.buynow');
        Route::get('delete/{id}','ShoppingCartController@delete')->name('get.shopping.delete');
        Route::get('update/{id}','ShoppingCartController@update')->name('ajax_get.shopping.update');

        Route::post('pay','ShoppingCartController@postPay')->name('post.shopping.pay');
        Route::get('pay-success','PaySuccessController@getPaySuccess')->name('get.pay.success');
   });

});

include 'route_admin.php';
include 'route_user.php';

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
