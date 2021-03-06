<?php

namespace Wangliang\Admin;

use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Admin
         */
        $this->publishes([
            realpath(__DIR__ . '/Admin/Admin') => base_path('app/Http/Controllers/Admin'),
        ]);

        //模型
        $this->publishes([
            realpath(__DIR__ . '/Admin/Models') => base_path('app/Models/Admin'),
        ]);

        //路由
        $this->publishes([
            realpath(__DIR__ . '/Admin/Routes') => base_path('routes/Admin'),
        ]);

        //验证类
        $this->publishes([
            realpath(__DIR__ . '/Admin/Requests') => base_path('app/Http/Requests/Admin'),
        ]);

        //配置文件
        if(file_exists(config_path('constants.php'))==false){
            $this->publishes([
                __DIR__.'/config/constants.php' => config_path('constants.php'),
            ]);
        }

        //迁移文件
        $this->publishes([
            realpath(__DIR__ . '/database/migrations') => base_path('/database/migrations'),
        ]);

        //填充文件
        $this->publishes([
            realpath(__DIR__ . '/database/seeds') => base_path('/database/seeds'),
        ]);

        //容器
        $this->publishes([
            realpath(__DIR__ . '/Admin/ViewComposers') => base_path('app/Http/ViewComposers'),
        ]);

        //视图
        $this->publishes([
            realpath(__DIR__ . '/Admin/views') => base_path('resources/views'),
        ]);

        //样式文件
        $this->publishes([
            realpath(__DIR__ . '/Admin/style') => public_path('style'),
        ]);
          
        //路由中间件
        $this->publishes([
            __DIR__.'/Admin/CheckLogin.php' => app_path('Http/Middleware/CheckLogin.php'),
        ]);     
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('admin', function ($app) {
            return new admin();
        });
    }
}
