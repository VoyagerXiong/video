
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>HDCMS开源免费-微信/桌面/移动三网通CMS系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <script>
        //HDJS组件需要的配置
        window.hdjs = {
            'base': '{{asset('node_modules/hdjs')}}',
            'uploader': 'http://www.houdunren.com?s=component/upload/uploader',
            'filesLists': 'http://www.houdunren.com?s=component/upload/filesLists',
            'removeImage': 'http://www.houdunren.com?s=component/upload/removeImage',
            'ossSign': 'http://www.houdunren.com?s=component/oss/sign'
        }
    </script>
    <script src="{{asset('js/require.js?version=v2.1.2')}}"></script>
    <script src="{{asset('js/config.js?version=v2.1.2')}}"></script>
    <link href="{{asset('css/hdcms.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('node_modules/hdjs/dist/hdjs.css')}}">
    <script>
        require(['hdjs'], function () {
            //为异步请求设置CSRF令牌
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
</head>
<body>
<div class="hdcms-login" hd-cloak="">
    <div class="container logo">
        <div style="background: url('{{asset('images/logo.png')}}') no-repeat; background-size: contain;height: 60px;"></div>
    </div>
    <div class="container well">
        <div class="row ">
            <div class="col-md-6">
                <form method="post" action="">
                    <div class="form-group">
                        <label>帐号</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-w fa-user"></i></div>
                            <input type="text" name="username" class="form-control input-lg" placeholder="请输入帐号" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>密码</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-w fa-key"></i></div>
                            <input type="password" name="password" class="form-control input-lg" placeholder="请输入密码" value="">
                        </div>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>
                    @endif
                    <div class="btn-group">
                        {{csrf_field()}}
                        <button class="btn btn-primary btn-lg">登录</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div style="background: url('{{asset('images/houdunwang.jpg')}}');background-size:100% ;height:230px;"></div>
            </div>
        </div>
        <div class="copyright">
            Powered by hdcms v2.0 © 2014-2019 www.hdcms.com
        </div>
    </div>
</div>
<script>
    function post(event) {
        event.preventDefault();
        require(['hdjs'], function (hdjs) {
            hdjs.submit({
                successUrl: '',
                callback: function (response) {
                    if (response.valid == 1) {
                        hdjs.message(response.message, response.url);
                    } else {
                        hdjs.message(response.message, '', 'info');
                    }
                }
            });
        })
    }
</script>
<div hd-loading="">
    <span class="timer-loader">Loading…</span>
</div>
</body>
</html>