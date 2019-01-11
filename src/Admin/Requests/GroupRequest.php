<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'group_name' => ['required', 'max:10'],
        ];
    }

    public function messages()
    {
        return [
            'group_name.required' => '请添加用户组名称',
            'group_name.max' => '请保持在10字以内',
        ];
    }
}
