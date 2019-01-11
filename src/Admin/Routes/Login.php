<?php

use Illuminate\Support\Facades\Config;

Route::middleware('admin')->domain(Config::get('constants.ADMIN_URL'))->namespace('Admin')->group(function () {

    //登录页
    Route::get('/login/index', 'LoginController@index')->name('login.index');

    //提交登录
    Route::post('/login/login', 'LoginController@login')->name('login.login');

    //登录页
    Route::get('/', 'LoginController@index')->name('login.index');

    //退出登录
    Route::get('/login/loginout', 'LoginController@loginout')->name('login.loginout');


});