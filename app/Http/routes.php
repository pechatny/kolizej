<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['namespace' => 'Admin'], function()
{
    Route::group(['prefix' => 'admin'], function()
    {
        Route::get("/", "AdminController@index");

        Route::group(['prefix' => 'menu'], function()
        {
            Route::get("/", "MenuController@index");
            Route::get("edit/{id}", "MenuController@edit");
            Route::get("create", "MenuController@create");
            Route::put("store", "MenuController@store");
            Route::put("update/{id}", "MenuController@update");
            Route::get("delete/{id}", "MenuController@destroy");

        });

        Route::group(['prefix' => 'pages'], function()
        {
            Route::get("/", "PagesController@index");
            Route::get("edit/{id}", "PagesController@edit");
            Route::get("create", "PagesController@create");
            Route::put("store", "PagesController@store");
            Route::put("update/{id}", "PagesController@update");
            Route::get("delete/{id}", "PagesController@destroy");

        });

        Route::group(['prefix' => 'categories'], function()
        {
            Route::any("/", "CategoriesController@index");
            Route::any("edit/{id}", "CategoriesController@edit");
            Route::any("create", "CategoriesController@create");
            Route::any("store", "CategoriesController@store");
            Route::any("update/{id}", "CategoriesController@update");
            Route::any("delete/{id}", "CategoriesController@destroy");

        });

        Route::group(['prefix' => 'colors'], function()
        {
            Route::any("/", "ColorsController@index");
            Route::any("edit/{id}", "ColorsController@edit");
            Route::any("create", "ColorsController@create");
            Route::any("store", "ColorsController@store");
            Route::any("update/{id}", "ColorsController@update");
            Route::any("delete/{id}", "ColorsController@destroy");

        });

        Route::group(['prefix' => 'products'], function()
        {
            Route::any("/", "ProductsController@index");
            Route::any("edit/{id}", "ProductsController@edit");
            Route::any("create", "ProductsController@create");
            Route::any("store", "ProductsController@store");
            Route::any("update/{id}", "ProductsController@update");
            Route::any("delete/{id}", "ProductsController@destroy");

        });
    });
});

Route::group(['namespace' => 'Site'], function()
{
    Route::get("/", "IndexController@index");
    Route::get("catalog", "CatalogController@index");
    Route::any("catalogUpdate", "CatalogController@ajaxUpdate");
    Route::get("catalog/{category}", "CatalogController@category");
    Route::get("catalog/product/{id}", "CatalogController@detail");
    Route::get("{page}", "PagesController@index");
});


Route::group(['prefix' => 'cart', 'namespace' => 'Site'], function()
{
    Route::any("add", "CartController@add");
});






