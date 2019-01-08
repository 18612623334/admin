<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/1
 * Time: 16:43
 */
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class ShareComposer{

    /**
     * 用户仓库实现.
     *
     * @var UserRepository
     */
    protected $users;

    protected $username;

    protected $roleView;

    protected $navigation;

    protected $uid;

    /**
     * 创建一个新的属性composer.
     *
     * @param UserRepository $users
     * @return void
     */
    public function __construct(Request $request)
    {

        $username = session('username');

        $admin_array_rule = session('navigation');

        $admin_id = session('id');

        $this -> navigation = $admin_array_rule;

        $this->username = $username;

        $this -> admin_id = $admin_id;

        // 依赖注入通过服务容器自动解析...
        //$this->users = $users;
    }

    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('adminusername', $this->username);

        $view->with('navigation' , $this->navigation);

        $view->with('admin_id' , $this->admin_id);
    }

}

