<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminGroup extends Model
{

    protected $table = 'admin_group';

    //获取分组管理列表
    public static function getRequestList($request)
    {
        return self::where(function ($q) use ($request) {
            $request->group_name && $q->where('group_name', 'like', '%' . htmlspecialchars($request->group_name) . '%');
        })->paginate(10);
    }
}