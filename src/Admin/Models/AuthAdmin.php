<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\Config;

class AuthAdmin
{

    //验证用户角色
    public static function checkAdminRule($admin, $rule)
    {
        $super_aid = Config::get('constants.SUPER_ADMIN_ID');

        if ($super_aid == $admin) {
            return true;
        }

        $all_rule = self::ruleAll();

        $user_rule = self::userRule($admin);

        //路由地址错误
        if (!in_array($rule, $all_rule)) {
            return false;
        }

        if (in_array($rule, $user_rule)) {
            return true;
        }
        return false;
    }

    //验证地址是否存在
    public static function ruleAll()
    {
        $has_session_rule_all = session('rule_all');
        if ($has_session_rule_all) {
            $data = session('rule_all');
        } else {
            $list = AdminRule::get(['url'])->toArray();
            $data = [];
            foreach ($list as $key => $value) {
                $data[] = $value['url'];
            }
            session(['rule_all' => $data]);
        }
        return $data;
    }

    //获取用户所拥有的权限
    public static function userRule($admin)
    {
        //用户所属用户组
        $user_rule = session('user_rule_group');

        if ($user_rule) {
            $user_rule = session('user_rule_group');
        } else {
            $user_rule = self::userRuleGroup($admin);
            session(['user_rule_group' => $user_rule]);
        }
        return $user_rule;
    }

    public static function userRuleGroup($admin)
    {
        $user_group = AdminUserHasGroup::where('admin_id', $admin)->first();

        if ($user_group) {
            //获取所有的路由信息
            $user_rule = AdiminGroupHasRule::where('group_gid', $user_group->group_id)->get()->toArray();

            $data = [];
            foreach ($user_rule as $value) {
                $data[] = $value['rule_rid'];
            }

            $user_rule = array_unique($data);
            if ($user_rule) {

                $user_rule_data = AdminRule::whereIn('id', $data)->select('url')->get()->toArray();
                $tmp = [];
                foreach ($user_rule_data as $value) {
                    $tmp[] = $value['url'];
                }

                $user_rule_data = array_unique($tmp);
            }
            return $user_rule_data;
        }
    }
}