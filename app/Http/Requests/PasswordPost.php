<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordPost extends FormRequest
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
        $this->passwordValidator();
        return [
            'old_password'=>'sometimes|required|check_password',
            'password'=>'sometimes|required|min:6|confirmed',
            'password_confirmation'=>'sometimes|required',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required'=>'原始密码必填',
            'old_password.check_password'=>'原始密码不正确',
            'password.required'=>'新密码必填',
            'password.min'=>'新密码长度不得少于6位',
            'password.confirmed'=>'两次密码输入不一致',
            'password_confirmation.required'=>'密码必填',
        ];
    }

    public function passwordValidator(){
        Validator::extend('check_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value,Auth::guard('admin')->user()->password);
        });
    }
}
