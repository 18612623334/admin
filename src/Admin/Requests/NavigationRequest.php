<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NavigationRequest extends FormRequest
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
            'navigation_name' => ['required', 'max:10'],
        ];
    }

    public function messages()
    {
        return [
            'navigation_name.required' => '请添加用户组名称',
            'navigation_name.max' => '请保持在10字以内',
        ];
    }
}
