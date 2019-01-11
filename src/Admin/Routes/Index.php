<?php

use Illuminate\Support\Facades\Config;

Route::middleware('admin')->domain(Config::get('constants.ADMIN_URL'))->namespace('Admin')->group(function () {

    //首页
    Route::get('/index/index', 'IndexController@index')->name('index.index');

    //欢迎页面
    Route::get('/index/welcome', 'IndexController@welcome')->name('index.welcome');
    
    //首页echart图形
    Route::post('/index/get-echart', 'IndexController@getEchart')->name('index.get-echart');

});