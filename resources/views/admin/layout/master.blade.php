<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('bt3/css/bootstrap.min.css')}}">
    <script src="https://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
    <script src="{{asset('bt3/js/bootstrap.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        //HDJS组件需要的配置
        window.hdjs = {
            'base': '{{asset('node_modules/hdjs')}}',
            'uploader': '/uploader',
            'filesLists': 'http://www.houdunren.com?s=component/upload/filesLists',
            'removeImage': 'http://www.houdunren.com?s=component/upload/removeImage',
            'ossSign': 'http://www.houdunren.com?s=component/oss/sign'
        }
    </script>
    <script src="{{asset('js/require.js?version=v2.1.2')}}"></script>
    <script src="{{asset('js/config.js?version=v2.1.2')}}"></script>
    <script>
        //放在require.js下面
        $(function($){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation" style="border-radius: 0;">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">laravel视频站开发</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">后台首页</a></li>
                <li><a href="/" target="_blank">前台首页</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::guard('admin')->user()->username}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/password">修改密码</a></li>
                        <li><a href="/admin/logout">退出登陆</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
<div class="container">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">用户管理</h3>
            </div>
            <div class="list-group">
                <a href="/admin/password" class="list-group-item">修改密码</a>
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">标签管理</h3>
            </div>
            <div class="list-group">
                <a href="/admin/tag" class="list-group-item">标签列表</a>
                <a href="/admin/tag/create" class="list-group-item">标签添加</a>
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">课程管理</h3>
            </div>
            <div class="list-group">
                <a href="/admin/lesson" class="list-group-item">课程列表</a>
                <a href="/admin/lesson/create" class="list-group-item">课程添加</a>
            </div>
        </div>
    </div>
    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
        @yield('content')
    </div>
</div>
</body>
</html>