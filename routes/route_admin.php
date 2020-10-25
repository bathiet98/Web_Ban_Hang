<?php

    Route::group(['prefix'=>'admin-auth','namespace'=>'Admin\Auth'],function (){
       Route::get('login','AdminLoginController@getloginAdmin')->name('get.login.admin');
       Route::post('login','AdminLoginController@postloginAdmin');
       Route::get('logout','AdminLoginController@getLogoutAdmin')->name('get.logout.admin');
    });

    Route::group(['prefix' => 'laravel-filemanager','middleware' => ['web', 'check_admin_login']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::group(['prefix' => 'api-admin', 'namespace' =>'Admin','middleware'=>'check_admin_login'], function (){
       Route::get('/', function (){
           return view('admin.index');
       });

        Route::get('statistical','AdminStatisticalController@index')->name('admin.statistical');

       /*
        * Route danh muc san pham
        * */
       Route::group(['prefix' => 'category'], function (){
          Route::get('/','AdminCategoryController@index')->name('admin.category.index');
          Route::get('create','AdminCategoryController@create')->name('admin.category.create');
          Route::post('create','AdminCategoryController@store');

          Route::get('update/{id}', 'AdminCategoryController@edit')->name('admin.category.update');
          Route::post('update/{id}', 'AdminCategoryController@update');


           Route::get('active/{id}', 'AdminCategoryController@active')->name('admin.category.active');
           Route::get('hot/{id}', 'AdminCategoryController@hot')->name('admin.category.hot');
           Route::get('delete/{id}', 'AdminCategoryController@delete')->name('admin.category.delete');
       });

        /*
         * Route keyword
         * */
        Route::group(['prefix' => 'keyword'], function (){
            Route::get('/','AdminKeywordController@index')->name('admin.keyword.index');
            Route::get('create','AdminKeywordController@create')->name('admin.keyword.create');
            Route::post('create','AdminKeywordController@store');

            Route::get('update/{id}', 'AdminKeywordController@edit')->name('admin.keyword.update');
            Route::post('update/{id}', 'AdminKeywordController@update');

            Route::get('hot/{id}', 'AdminKeywordController@hot')->name('admin.keyword.hot');
            Route::get('delete/{id}', 'AdminKeywordController@delete')->name('admin.keyword.delete');
        });

        /*
         * Route products
         * */
        Route::group(['prefix' => 'product'], function (){
            Route::get('/','AdminProductController@index')->name('admin.product.index');
            Route::get('create','AdminProductController@create')->name('admin.product.create');
            Route::post('create','AdminProductController@store');

            Route::get('update/{id}', 'AdminProductController@edit')->name('admin.product.update');
            Route::post('update/{id}', 'AdminProductController@update');

            Route::get('hot/{id}', 'AdminProductController@hot')->name('admin.product.hot');
            Route::get('active/{id}', 'AdminProductController@active')->name('admin.product.active');
            Route::get('delete/{id}', 'AdminProductController@delete')->name('admin.product.delete');

            Route::get('delete-image/{id}','AdminProductController@deleteImage')->name('admin.product.delete_image');
        });


        /*
         * Route attribute
         * */
        Route::group(['prefix' => 'attribute'], function (){
            Route::get('/','AdminAttributeController@index')->name('admin.attribute.index');
            Route::get('create','AdminAttributeController@create')->name('admin.attribute.create');
            Route::post('create','AdminAttributeController@store');

            Route::get('update/{id}', 'AdminAttributeController@edit')->name('admin.attribute.update');
            Route::post('update/{id}', 'AdminAttributeController@update');

            Route::get('hot/{id}', 'AdminAttributeController@hot')->name('admin.attribute.hot');
            Route::get('delete/{id}', 'AdminAttributeController@delete')->name('admin.attribute.delete');
        });

        /*
         * Route Khách hàng
         * */
        Route::group(['prefix' => 'user'], function (){
            Route::get('/','AdminUserController@index')->name('admin.user.index');
            Route::get('delete/{id}', 'AdminUserController@delete')->name('admin.user.delete');
        });

        /*
         * Route xử lý đơn hàng, xem chi tiết đơn hàng
         * */
        Route::group(['prefix' => 'transaction'], function (){
            Route::get('/','AdminTransactionController@index')->name('admin.transaction.index');
            Route::get('delete/{id}', 'AdminTransactionController@delete')->name('admin.transaction.delete');
            Route::get('action/{action}/{id}', 'AdminTransactionController@getTransactionAction')->name('admin.get.transaction.action');

            Route::get('view-transaction/{id}', 'AdminTransactionController@getTransactionDetail')->name('ajax.admin.transaction.detail');
            Route::get('order-delete/{id}', 'AdminTransactionController@deleteOrderItem')->name('ajax.admin.transaction.delete.order.item');
        });


        /*
        * Route Menu
        * */
        Route::group(['prefix' => 'menu'], function (){
            Route::get('/','AdminMenuController@index')->name('admin.menu.index');
            Route::get('create','AdminMenuController@create')->name('admin.menu.create');
            Route::post('create','AdminMenuController@store');

            Route::get('update/{id}', 'AdminMenuController@edit')->name('admin.menu.update');
            Route::post('update/{id}', 'AdminMenuController@update');


            Route::get('active/{id}', 'AdminMenuController@active')->name('admin.menu.active');
            Route::get('hot/{id}', 'AdminMenuController@hot')->name('admin.menu.hot');
            Route::get('delete/{id}', 'AdminMenuController@delete')->name('admin.menu.delete');
        });


        /*
       * Route article
       * */
        Route::group(['prefix' => 'article'], function (){
            Route::get('/','AdminArticleController@index')->name('admin.article.index');
            Route::get('create','AdminArticleController@create')->name('admin.article.create');
            Route::post('create','AdminArticleController@store');

            Route::get('update/{id}', 'AdminArticleController@edit')->name('admin.article.update');
            Route::post('update/{id}', 'AdminArticleController@update');


            Route::get('active/{id}', 'AdminArticleController@active')->name('admin.article.active');
            Route::get('hot/{id}', 'AdminArticleController@hot')->name('admin.article.hot');
            Route::get('delete/{id}', 'AdminArticleController@delete')->name('admin.article.delete');
        });

        /*
      * Route Slide
      * */
        Route::group(['prefix' => 'slide'], function (){
            Route::get('/','AdminSideController@index')->name('admin.slide.index');
            Route::get('create','AdminSideController@create')->name('admin.slide.create');
            Route::post('create','AdminSideController@store');

            Route::get('update/{id}', 'AdminSideController@edit')->name('admin.slide.update');
            Route::post('update/{id}', 'AdminSideController@update');


            Route::get('active/{id}', 'AdminSideController@active')->name('admin.slide.active');
            Route::get('hot/{id}', 'AdminSideController@hot')->name('admin.slide.hot');
            Route::get('delete/{id}', 'AdminSideController@delete')->name('admin.slide.delete');
        });
    });
