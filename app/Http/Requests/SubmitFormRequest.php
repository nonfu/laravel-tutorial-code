<?php

namespace App\Http\Requests;

use App\Rules\SensitiveWordRule;
use Illuminate\Foundation\Http\FormRequest;

class SubmitFormRequest extends FormRequest
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
            'title' => [
                'bail',
                'required',
                'string',
                'between:2,32',
                new SensitiveWordRule()
            ],
            'url' => 'sometimes|url|max:200',
            'picture' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题字段不能为空',
            'title.string' => '标题字段仅支持字符串',
            'title.between' => '标题长度必须介于2-32之间',
            'url.url' => 'URL格式不正确，请输入有效的URL',
            'url.max' => 'URL长度不能超过200',
        ];
    }

    public function attributes()
    {
        return [
            'title' => '标题',
            'url' => 'URL',
            'picture' => '图片'
        ];
    }
}
