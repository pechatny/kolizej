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
    });
});

Route::group(['namespace' => 'Site'], function()
{
    Route::get("/", "IndexController@index");
    Route::get("{page}", "IndexController@index");
});




