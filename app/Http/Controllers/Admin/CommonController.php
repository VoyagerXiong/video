<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function __construct() {
        $this->middleware('admin.auth')->except(['login']);
    }

}
