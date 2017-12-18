<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EntryController extends CommonController
{

    public function index(){
        return view('admin.entry.index');
    }

    public function login(Request $request){
        if($request->ismethod('post')){
            $status = Auth::guard('admin')->attempt(
                [
                    'username'=>$request->post('username'),
                    'password'=>$request->post('password'),
                ]
            );
            if($status){
                return redirect('/admin/index');
            }
            return redirect('/admin/login')->with('error','用户名或密码错误');
        }
        return view('admin.entry.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
