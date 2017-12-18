@extends('admin.layout.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">用户管理</h3>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="/admin/password">修改密码</a></li>
            </ul>
            <br>
            <form action="/admin/changePassword" method="post" class="form-horizontal" role="form" >
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">原始密码:</label>
                    <div class="col-sm-10">
                        <input type="text" name="old_password" id="inputID" class="form-control" value="" title="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">新密码:</label>
                    <div class="col-sm-10">
                        <input type="text" name="password" id="inputID" class="form-control" value="" title="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">确认密码:</label>
                    <div class="col-sm-10">
                        <input type="text" name="password_confirmation" id="inputID" class="form-control" value="" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-primary">修改密码</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- TAB NAVIGATION -->
    @include('flash::message')
    <script>
        $(function(){
            $('#flash-overlay-modal').modal();
            setTimeout(function(){
                $('#flash-overlay-modal').modal('hide');

            },2000)
        });
    </script>


@endsection