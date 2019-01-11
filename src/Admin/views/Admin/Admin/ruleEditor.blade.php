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
                    <h5>路由信息管理 <small></small></h5>
                </div>
                <div class="ibox-content">
                    <div method="get" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">路由名称</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="{{$info['name']}}" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">路由地址</label>
                            <div class="col-sm-10">
                                <input type="text" name="url" value="{{$info['url']}}" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">路由参数</label>
                            <div class="col-sm-10">
                                <input type="text" name="parameter" value="{{$info['parameter']}}" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">是否显示导航</label>
                            <div class="col-sm-10" style="padding-top: 5px;">
                                <input type="radio" name="status" value="1" @if($info['status'] == 1) checked @endif/>
                                <span>显示</span>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="status" value="0" @if($info['status'] == 0) checked @endif/>
                                <span>不显示</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <input type="hidden" name="id" value="{{$info['id']}}">
                                <input type="hidden" name="naviagtion_id" value="{{$naviagtion_id}}">
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

        postMsg.name = $('input[name=name]').val();
        postMsg.url = $('input[name=url]').val();
        postMsg.status = $('input[name=status]:checked').val();
        postMsg.id = $('input[name=id]').val();
        postMsg.naviagtion_id = $('input[name=naviagtion_id]').val();
        postMsg.parameter = $('input[name=parameter]').val();

        $.ajax({
            type: "POST",
            url: "{{ URL::route('admin.editor-rule-data')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: postMsg,
            dataType: "json",
            success: function (msg) {
                canLogin = 1;
                if (msg.status=="1") {
                    layer.msg("保存成功", {time: 1500}, function () {
                        window.location.href = "/admin/route-list?id="+msg.data;
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