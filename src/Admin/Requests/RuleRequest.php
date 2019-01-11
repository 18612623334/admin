<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RuleRequest extends FormRequest
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
            'name' => ['required', 'max:10'],
            'url' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '请输入路由名称',
            'name.max' => '请保持在10字以内',
            'url.required' => '请输入路由地址'
        ];
    }
}
