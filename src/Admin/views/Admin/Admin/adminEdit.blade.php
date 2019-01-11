<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>后台 - 管理员</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/style/css/bootstrap.min.css?v=3.3.7" rel="stylesheet">
    <link href="/style/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/style/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/style/css/animate.min.css" rel="stylesheet">
    <link href="/style/css/style.css?v=4.0.0" rel="stylesheet"><base target="_blank">
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>@if($admin_type==1) 添加管理员 @else 编辑管理员 @endif<small></small></h5>
                </div>
                <div class="ibox-content">
                    <div method="get" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">管理员名称</label>
                            <div class="col-sm-10">
                                <input type="text" name="admin_name" value="{{$admin_data['username']}}" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">管理员账号</label>
                            <div class="col-sm-10">
                                <input type="text" name="account" value="{{$admin_data['account']}}" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">管理员密码</label>
                            <div class="col-sm-10">
                            @if($admin_type==1)
                                <input type="password" name="password" class="form-control">
                            @else
                                <input type="password" name="password" placeholder="********" class="form-control">
                            @endif
                            </div>
                        </div>
                        @if($admin_type==1)

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">确认密码</label>
                            <div class="col-sm-10">
                            @if($admin_type==1)
                                <input type="password" name="password_confirmation" class="form-control">
                            @else
                                <input type="password" name="password_confirmation" placeholder="密码（如不填择不修改密码,最多输入15字符）" class="form-control">
                            @endif
                            </div>
                        </div>
                        @endif

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">管理员类型：</label>
                            <div class="col-md-10">
                                @if($admin_data['id'] == '1')
                                <select class="form-control" name="group_id">
                                    <option value="1">超级管理员</option>
                                </select>
                                @else
                                <select class="form-control" name="group_id">
                                    <option value="">请选择类型</option>
                                    @foreach($group_list as $k=>$v)
                                        <option value="{{$v['id']}}" @if($v['id'] == $admin_data['admin_has_group']['group_id']) selected @endif>{{$v['group_name']}}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">管理员状态</label>
                            <div class="col-sm-10">
                                <input type="radio" name="status" value="1" @if($admin_data['status'] == 1) checked @endif/>
                                <span>启用</span>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="status" value="0" @if($admin_data['status'] == 0) checked @endif/>
                                <span>禁用</span>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <input type="hidden" name="id" value="{{$admin_data['id']}}">
                                <input type="hidden" name="admin_type" value="{{$admin_type}}">
                                <button class="btn btn-primary" type="submit">保存内容</button>
                                <button class="btn btn-white" type="submit">取消</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/style/js/jquery.min.js?v=2.1.4"></script>
<script src="/style/js/bootstrap.min.js?v=3.3.7"></script>
<script src="/style/js/content.min.js?v=1.0.0"></script>
<script src="/style/layer/layer.js"></script>
<script src="/style/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>
<script>
    var canPost = 1;

    $('.btn-primary').on('click',function(){

        if(canPost==0){
            return false;
        }

        var postMsg = {};

        postMsg.admin_name = $('input[name=admin_name]').val();
        postMsg.account = $('input[name=account]').val();
        postMsg.password = $('input[name=password]').val();
        postMsg.password = $('input[name=password]').val();
        postMsg.password_confirmation = $('input[name=password_confirmation]').val();
        postMsg.status = $('input[name=status]:checked').val();
        postMsg.id = $('input[name=id]').val();
        postMsg.group_id = $('select[name=group_id]').val();

        if($('input[name=admin_type]').val()==2){
            var url = "{{ URL::route('admin.update-data')}}";
        }else if($('input[name=admin_type]').val()==1){
            var url = "{{ URL::route('admin.add-data')}}";
        }

        $.ajax({
            type: "POST",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: postMsg,
            dataType: "json",
            success: function (msg) {
                canLogin = 1;
                if (msg.status=="1") {
                    layer.msg("保存成功", {time: 1500}, function () {
                        window.location.href = "{{ URL::route('admin.index')}}";
                    });
                } else {
                    layer.msg(msg.msg);
                }
            },
            error : function (msg ) {
                var json=JSON.parse(msg.responseText);
                $.each(json.errors, function(idx, obj) {
                    layer.msg(obj[0]);
                    return false;
                });
            },
        }, "json");
    });

    $(".btn-white").on('click',function(){
        history.go(-1);
    });
</script>
</html>