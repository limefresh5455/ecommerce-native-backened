<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Routes
    Route::group(['namespace' => 'Api'], function() {
    Route::post('/register','UserController@register');
    Route::post('/login','UserController@login');
 
    
    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::post('/category_add','CategoriesController@Category_add');
        Route::get('/product_category/{id}','ProductController@product_category');
        Route::post('/product_add','ProductController@product_add');
        Route::get('/getData','UserController@getData');
        Route::post('/getProduct','ProductController@getProduct');
        Route::get('/getCategory','CategoriesController@getCategory');
        Route::post('/add_cart','CartController@addCart');
        Route::get('/get_cart','CartController@getCart');
        Route::get('/getAllCart','CartController@getAllCart');
        Route::post('logout', 'UserController@logout');
    });
});