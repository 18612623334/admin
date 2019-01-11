<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use App\Models\Admin\AdminGroup;
use App\Models\Admin\AdminNavigation;
use App\Models\Admin\AdminRule;
use App\Models\Admin\AdminUserHasGroup;
use App\Models\Admin\AdiminGroupHasRule;
use App\Http\Requests\Admin\AdminAddRequest;
use App\Http\Requests\Admin\AdminEditRequest;
use App\Http\Requests\Admin\GroupRequest;
use App\Http\Requests\Admin\RuleRequest;
use App\Http\Requests\Admin\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class AdminController extends BaseController
{
    /**
     * 管理员列表
     */
    public function index(Request $request)
    {
        $list = Admin::getList($request);

        return view('Admin.Admin.admin', [
            'list' => $list
        ]);
    }

    /**
     * 管理员操作页面
     */
    public function editorAdmin(Request $request)
    {
        $admin_id = $request->input('admin_id');

        $admin_data = Admin::where(['id' => $admin_id])->with('adminHasGroup')->first()->toArray();

        $admin_type = $request->input('admin_type');

        //管理员用户组的划分
        $group_list = AdminGroup::get()->toArray();

        return view('Admin.Admin.adminEdit', [
            'admin_data' => $admin_data,
            'group_list' => $group_list,
            'admin_type' => $admin_type
        ]);
    }

    /**
     * 管理员状态(禁用&&启用)
     */
    public function adminStatus(Request $request)
    {
        $admin_id = $request->input('admin_id');

        if ($admin_id == '1') {
            return ['status' => '0', 'msg' => '请勿修改超级管理信息'];
        }

        $data = Admin::find($admin_id);
        $data->status = $request->input('status');
        $res = $data->save();

        if ($res) {
            return ['status' => '1', 'msg' => '成功'];
        } else {
            return ['status' => '0', 'msg' => '请检查数据是否正确'];
        }
    }

    /**
     * 管理员添加
     */
    public function adminAddData(AdminAddRequest $request)
    {
        DB::beginTransaction();

        $admin = new Admin();
        $admin->username = $request->input('admin_name');
        $admin->account = $request->input('account');
        $admin->password = bcrypt($request->input('password'));
        $admin->status = $request->input('status');
        $admin->save();
        $admin_id = $admin->id;

        $use_has_group = new AdminUserHasGroup();
        $use_has_group->admin_id = $admin_id;
        $use_has_group->group_id = $request->input('group_id');
        $res = $use_has_group->save();

        if ($admin && $res) {
            DB::commit();
            return ['status' => '1', 'msg' => '添加成功'];
        } else {
            DB::rollback();
            return ['status' => '0', 'msg' => '添加失败'];
        }
    }

    /**
     * 管理员编辑
     */
    public function adminUpdateData(AdminEditRequest $request)
    {
        DB::beginTransaction();

        $admin = Admin::find($request->input('id'));

        $password = $request->input('password');
        if ($password) {
            if (strlen($password) < 6 || strlen($password) > 15) {
                return ['status' => '0', 'msg' => '请输入6~15位密码'];
            }
            $admin->password = bcrypt($request->input('password'));
        }
        $admin->username = $request->input('admin_name');
        $admin->account = $request->input('account');
        $admin->status = $request->input('status');
        $admin = $admin->save();

        $data['group_id'] = $request->group_id;

        if (Config::get('constants.SUPER_ADMIN_ID') == $request->id) {
            $res = true;
        } else {
            $res = AdminUserHasGroup::where('admin_id', $request->id)->update($data);
        }

        if ($admin && $res) {
            DB::commit();
            return ['status' => '1', 'msg' => '修改成功'];
        } else {
            DB::rollback();
            return ['status' => '0', 'msg' => '修改失败'];
        }
    }

    /**
     * 用户组列表
     */
    public function adminGroup(Request $request)
    {
        $group_list = AdminGroup::getRequestList($request);

        return view('Admin.Admin.group', [
            'list' => $group_list
        ]);
    }

    /**
     * 用户组编辑页面
     */
    public function groupEditor(Request $request)
    {
        $id = $request->input('group_id');

        $group_info = AdminGroup::find($id);

        return view('Admin.Admin.groupEditor', [
            'group_info' => $group_info
        ]);
    }

    /**
     * 用户组名称保存
     */
    public function groupCreated(GroupRequest $request)
    {
        if ($request->group_id) {
            $data = AdminGroup::find($request->group_id);
        } else {
            $data = new AdminGroup();
        }

        $data->group_name = $request->input('group_name');
        $res = $data->save();

        if ($res) {
            return ['status' => '1', 'msg' => '成功'];
        } else {
            return ['status' => '0', 'msg' => '失败'];
        }
    }

    /**
     * 路由导航列表
     */
    public function ruleRoute(Request $request)
    {
        $list = AdminNavigation::getList($request);

        return view('Admin.Admin.rule', [
            'list' => $list
        ]);
    }

    /**
     * 路由导航编辑
     */
    public function navigationEditor(Request $request)
    {
        $id = $request->input('id');

        $list = AdminNavigation::find($id);

        return view('Admin.Admin.navigationEditor', [
            'admin_data' => $list
        ]);
    }

    /**
     * 路由导航(保存 或 编辑)
     */
    public function navigationUpdate(Request $request)
    {
        if ($request->input('id')) {
            $data = AdminNavigation::find($request->input('id'));
        } else {
            $data = new AdminNavigation();
        }
        $navigation_name = $request->input('navigation_name');
        $navigation_sort = $request->input('navigation_sort');
        $data->navigation_name = $navigation_name;
        $data->navigation_sort = $navigation_sort ? $navigation_sort : 0;
        $res = $data->save();

        if ($res) {
            return ['status' => '1', 'msg' => '成功'];
        } else {
            return ['status' => '0', 'msg' => '失败'];
        }
    }

    /**
     * 子路由列表
     */
    public function routeList(Request $request)
    {
        $id = $request->input('id');

        $res = AdminRule::getList(['naviagtion_id' => $id]);

        return view('Admin.Admin.ruleList', [
            'list' => $res,
            'id' => $id
        ]);
    }

    /**
     * 子路由编辑页面
     */
    public function routeEditor(Request $request)
    {
        $id = $request->input('id');

        $naviagtion_id = $request->input('naviagtion_id');

        $info = AdminRule::find($id);

        return view('Admin.Admin.ruleEditor', [
            'info' => $info,
            'naviagtion_id' => $naviagtion_id
        ]);
    }

    /**
     * 子路由(保存 或 编辑)
     */
    public function editorRuleData(RuleRequest $request)
    {
        if ($request->input('id')) {
            $data = AdminRule::find($request->input('id'));
        } else {
            $data = new AdminRule();
        }

        $data->name = $request->input('name');
        $data->url = $request->input('url');
        $data->naviagtion_id = $request->input('naviagtion_id');
        $data->status = $request->input('status');
        $data->parameter = $request->input('parameter') ? $request->input('parameter') : '';
        $res = $data->save();

        if ($res) {
            return ['status' => '1', 'msg' => '成功', 'data' => $request->input('naviagtion_id')];
        } else {
            return ['status' => '0', 'msg' => '失败'];
        }
    }

    /**
     * 授权管理
     */
    public function authorization(Request $request)
    {
        $group_id = $request->input('group_id');

        //路由信息
        $rule_route = AdminRule::with(['adminNaviagtion' => function ($query) {
            $query->select('id', 'navigation_name');
        }])->get()->toArray();

        $array_route = [];
        foreach ($rule_route as $key => $value) {
            $array_route[$value['naviagtion_id']][] = $value;
        }

        //用户组信息
        $group_name = AdminGroup::find($group_id);

        //用户权限
        $rule = AdiminGroupHasRule::where('group_gid', $group_id)->get()->toArray();
        $tmp = [];
        foreach ($rule as $value) {
            $tmp[] = $value['rule_rid'];
        }

        return view('Admin.Admin.groupRule', [
            'array_route' => $array_route,
            'group_name' => $group_name,
            'rule' => $tmp
        ]);
    }

    /**
     * 授权管理保存
     */
    public function groupRuleData(AuthRequest $request)
    {
        DB::beginTransaction();

        $group_rule = explode(',', trim($request->input('group_rule'), ','));

        $group_has_rule_del = AdiminGroupHasRule::where('group_gid', $request->input('group_id'))->delete();

        $data = [];
        foreach ($group_rule as $key => $value) {
            $data[$key]['group_gid'] = $request->input('group_id');
            $data[$key]['rule_rid'] = $value;
        }

        $group_has_rule_insert = AdiminGroupHasRule::insert($data);

        if ($group_has_rule_del && $group_has_rule_insert) {
            DB::commit();
            return ['status' => '1', 'msg' => '成功'];
        } else {
            DB::rollback();
            return ['status' => '0', 'msg' => '失败'];
        }
    }

    //删除路由 (附带子路有)
    public function routeDel(Request $request)
    {
        $id = $request->input('id');

        $navigation = AdminNavigation::find($id);

        $navigation = $navigation->delete();

        $rule = AdminRule::where('naviagtion_id', $id)->delete();

        if ($res && $rule) {
            return ['status' => '1', 'msg' => '成功'];
        } else {
            return ['status' => '0', 'msg' => '失败'];
        }
    }

    //定义路由错误页面
    public function ruleErrors()
    {
        return view('Admin.Index.404');
    }
}