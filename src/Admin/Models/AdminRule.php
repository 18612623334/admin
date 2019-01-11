<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminRule extends Model
{
    protected $table = 'admin_rule';

    public static function getList($where)
    {
        return self::where($where)->paginate(10);
    }

    //获取角色导航
    public function adminNaviagtion()
    {
        return $this->belongsTo(AdminNavigation::class, 'naviagtion_id', 'id');
    }
}
