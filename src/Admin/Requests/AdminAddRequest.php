<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'admin_name' => ['required'],
            'account' => ['required', 'regex:/^[a-z\d]*$/i'],
            'password' => ['required', 'between:6,15', 'regex:/^([A-Z]|[a-z]|[0-9]|[_.]){6,15}$/', 'confirmed'],
            'password_confirmation' => ['required'],
            'group_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'admin_name.required' => '请输入管理员名称',
            'account.required' => '请输入管理员账号',
            'account.regex' => '不允许输入特殊字符',
            'password.required' => '请输入管理员密码',
            'password.between' => '请输入6~15位密码',
            'password.regex' => '只允许数字、字母、下划线',
            'password_confirmation.required' => '请输入确认密码',
            'password.confirmed' => '两次输入密码不一致',
            'group_id.required' => '请选择管理员类型',
        ];
    }
}
