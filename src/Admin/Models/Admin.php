<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';

    //获取管理员的角色
    public function adminHasGroup()
    {
        return $this->hasOne(AdminUserHasGroup::class, 'admin_id', 'id');
    }

    //获取管理员列表
    public static function getList($request)
    {
        return self::leftJoin('admin_user_has_group as has_group', 'has_group.admin_id', '=', 'admin.id')
            ->leftJoin('admin_group as group', 'group.id', '=', 'has_group.group_id')
            ->where(function ($q) use ($request) {
                $request->name && $q->where('admin.username', 'like', '%' . htmlspecialchars($request->name) . '%');
            })
            ->select(['admin.id', 'admin.account', 'admin.username', 'admin.status', 'admin.created_at', 'admin.updated_at', 'group.group_name as group'])
            ->paginate(10);
    }

    public static function AdminUserGroupList($admin_id)
    {
        return AdminUserHasGroup::leftjoin('admin_group_has_rule', 'admin_user_has_group.group_id', '=', 'admin_group_has_rule.group_gid')
            ->leftjoin('admin_rule', 'admin_rule.id', '=', 'admin_group_has_rule.rule_rid')
            ->where(['admin_rule.status' => '1'])
            ->where(['admin_user_has_group.admin_id' => $admin_id])
            ->get(['admin_rule.naviagtion_id', 'admin_rule.id'])
            ->toArray();
    }
}