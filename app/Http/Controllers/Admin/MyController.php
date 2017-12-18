<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\PasswordPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyController extends CommonController
{
    public function password(){
        return view('admin.my.password');
    }

    public function changePassword(Request $request,PasswordPost $passwordPost){
        if($request->isMethod('post')){
            $model = Auth::guard('admin')->user();
            $model->password = bcrypt($request->input('password'));
            $model->save();
            Auth::logout();
            return redirect('/admin/login');
//            flash()->overlay('密码修改成功','温馨提示');
        }
//        return view('admin.my.password');
    }
}
