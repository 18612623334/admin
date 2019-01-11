<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminNavigation extends Model
{

    protected $table = 'admin_navigation';

    //获取导航列表
    public static function getList($request)
    {
        return self::where(function ($q) use ($request) {
            $request->name && $q->where('navigation_name', 'like', '%' . htmlspecialchars($request->name) . '%');
        })->paginate(10);
    }
}