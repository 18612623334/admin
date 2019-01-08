laravel5.5 laravel_admin
### 通过Composer安装包。

#### 从终端运行Composer update命令：
```
"wangliang/laravel-admin":"^v1.2",
```
#### 在config/app    providers数组中添加一个新行：
```
Wangliang\Test\TestServiceProvider::class
```
#### 从终端运行发布服务 命令：
```
php artisan vendor:publish --  
```
#### 运行数据库迁移 (先删除框架自带的user数据迁移文件)(关掉laravel config/database 下的mysql 严格模式 strict:false)
#### 先修改 .env 数据库连接
```
php artisan migrate
```
#### 在 app/Providers/RouteServiceProvider 修改路由
##### 新增方法
```
protected function mapAdminRoutes()
{
    foreach (glob(base_path('routes/Admin') . '/*.php') as $file) {
        Route::middleware('admin')
            ->namespace($this->namespace)
            ->group($file);
    }
}
```
##### map方法添加
```
$this->mapAdminRoutes();
```
#### 修改app/Http/Kernel.php
```
middlewareGroups 数组中 web替换成admin
```
#### 在app/Providers/AppServiceProvider.php 
```
引入
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
boot方法中添加
View::composer(
    '*', 'App\Http\ViewComposers\ShareComposer'
);
```
#### 在app/Http/Kernel.php 路由中间件添加
```
'CheckLogin'=>\App\Http\Middleware\CheckLogin::class,
```
#### 配置后台登录图片验证码：
```
"mews/captcha": "^2.2",(这个百度一下  都有)
```
#### 注册providers（config/app.php）,在这个数组中的最后追加如下代码：
```
Mews\Captcha\CaptchaServiceProvider::class,
```
#### 注册aliases （config/app.php），在这个数组中的最后追加如下代码：
```
'Captcha' => Mews\Captcha\Facades\Captcha::class,
```
#### 从终端运行发布服务 命令：
```
php artisan vendor:publish
```
#### 因为Captcha 安装完后  默认的路由中间件是"web"需要换成"admin"
```
vendor\mews\captcha\src\CaptchaServiceProvider.php
```

#### 配置后台Auth:
##### 将配置文件 config/auth.php 
```
guards：新增
'admin' => [
     'driver' => 'session',
     'provider' => 'admins',
],
 providers：新增：
 'admins' => [
     'driver' => 'eloquent',
     'model' => App\Models\Admin\Admin::class,
 ],
 ```
 #### 运行数据填充：
 ```
 php artisan db:seed --class=AdminTableSeeder
 ```
后台账号密码：账号（admin）密码（123456）
OK 按照步骤走下来  项目已经基本上跑通  如果跑不通  去百度上  好好学习一下
