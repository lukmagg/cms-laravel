<?php
    
    // Prefijo /admin significa que todas las rutas dentro de esta funcion tendran ese prefijo
    //  antes del nombre.
    Route::prefix('/admin')->group(function(){

        Route::get('/', 'Admin\DashboardController@getDashboard');
        Route::get('/users', 'Admin\UserController@getUsers');

        // Module Products
        Route::get('/products', 'Admin\ProductController@getHome');
        Route::get('/product/add', 'Admin\ProductController@getProductAdd');
        Route::get('/product/{id}/edit', 'Admin\ProductController@getProductEdit');
        Route::post('/product/{id}/edit', 'Admin\ProductController@postProductEdit');
        Route::post('/product/add', 'Admin\ProductController@postProductAdd');
        Route::post('/product/{id}/gallery/add', 'Admin\ProductController@postProductGalleryAdd');
        Route::get('/product/{id}/gallery/{gid}/delete', 'Admin\ProductController@getProductGalleryDelete');



        // Categories
        Route::get('/categories/{module}', 'Admin\CategoriesController@getHome');
        Route::post('/category/add', 'Admin\CategoriesController@postCategoryAdd');
        Route::get('/category/{id}/edit', 'Admin\CategoriesController@getCategoryEdit');
        Route::post('/category/{id}/edit', 'Admin\CategoriesController@postCategoryEdit');
        Route::get('/category/{id}/delete', 'Admin\CategoriesController@getCategoryDelete');


    });


?>