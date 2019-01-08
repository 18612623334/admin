laravel5.5 Component_login
### 通过Composer安装包。

##### 配置后台Auth:
将配置文件 config/auth.php 
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
 运行数据填充：
 ```
 php artisan db:seed --class=AdminTableSeeder
 ```
后台账号密码：账号（admin）密码（123456）
OK 按照步骤走下来  项目已经基本上跑通  如果跑不通  去百度上  好好学习一下
