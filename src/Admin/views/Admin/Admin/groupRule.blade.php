<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>学会+ 后台 - 管理员</title>

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
                    <h5>编辑用户组 <small></small></h5>
                </div>
                <div class="ibox-content">
                    <div method="get" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户组名称</label>
                            <div class="col-sm-10">
                                <input type="text" name="group_name" value="{{$group_name['group_name']}}" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">权限管理</label>
                            <div class="col-sm-10">
                                @foreach($array_route as $value)
                                    <div style="">{{$value[0]['navigation_name']}}：</div>
                                    <div>
                                        @foreach($value as $v)
                                            <label class="checkbox-inline">
                                                <input type="checkbox" value="{{$v['id']}}" name="rule[]" id="chapterId" @if(in_array($v['id'],$rule)) checked @endif>
                                                <span>{{$v['name']}}</span>&nbsp;&nbsp;
                                            </label>
                                        @endforeach
                                    </div>
                                    <br/>
                                @endforeach
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <input type="hidden" name="group_id" value="{{$group_name['gid']}}">
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

        postMsg.group_id = $('input[name=group_id]').val();
        postMsg.group_name = $('input[name=group_name]').val();

        var group_rule = '';

        $.each($('input:checkbox:checked'),function(){
            group_rule += $(this).val()+"$$$";

        });
        postMsg.group_rule = group_rule;

        $.ajax({
            type: "POST",
            url: "{{ URL::route('admin.group-rule-data')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: postMsg,
            dataType: "json",
            success: function (msg) {
                canLogin = 1;
                if (msg.status=="1") {
                    layer.msg("保存成功", {time: 1500}, function () {
                        window.location.href = "{{ URL::route('admin.admin-group')}}";
                    });
                } else {
                    layer.msg(msg.msg);
                }
            }
        }, "json");
    });


    $(".btn-white").on('click',function(){
        history.go(-1);
    });

</script>

</html>