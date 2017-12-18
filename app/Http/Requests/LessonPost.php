<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonPost extends FormRequest
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
            'title'=>'sometimes|required',
            'introduce'=>'sometimes|required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'课程标题不能为空',
            'introduce.required'=>'课程介绍不能为空'
        ];
    }
}
