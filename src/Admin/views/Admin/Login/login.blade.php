<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台管理系统 - 登录</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico">
    <link href="/style/css/bootstrap.min.css?v=3.3.7" rel="stylesheet">
    <link href="/style/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <link href="/style/css/animate.min.css" rel="stylesheet">
    <link href="/style/css/style.min.css?v=4.0.1" rel="stylesheet"><base target="_blank">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>
<style type="text/css">
.form-controls, .single-lines {
    background-color: #FFF;
    background-image: none;
    border: 1px solid #e5e6e7;
    border-radius: 1px;
    color: inherit;
    padding: 6px 12px;
    -webkit-transition: border-color .15s ease-in-out 0s, box-shadow .15s ease-in-out 0s;
    transition: border-color .15s ease-in-out 0s, box-shadow .15s ease-in-out 0s;
    width: 50%;
    font-size: 14px;
    margin-left: -27px;
    height: 35px;
}
</style>

<body>

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div style="padding-top: 82px;">
        <div>
        </div>
        <h3>欢迎使用</h3>

            <div class="form-group">
                <input type="text" name="account" class="form-control admin-login" placeholder="账号" required="">
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control admin-login" placeholder="密码" required="">
            </div>

            <div class="form-group code">
                <input class="tt-text form-controls single-lines" name="captcha" placeholder="图片验证码">
                <img id="codePic" src="{{captcha_src()}}" onclick="getPic()" style="cursor:pointer">
                                             
            </div>

            <button type="submit" class="btn btn-primary block full-width m-b login captcha" >登 录</button>

    </div>
</div>

<script src="/style/js/jquery.min.js?v=2.1.4"></script>
<script src="/style/js/bootstrap.min.js?v=3.3.7"></script>
<script src="/style/layer/layer.js"></script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>

<script>

    var canLogin = 1;

    $(function () {

        $(".login").on("click", function () {
            login();
        });

        $('.admin-login').keydown(function (event) {
            if (event.keyCode == 13) {
                login();
            }
        });
    })

    function getPic(){ 
        $("#codePic").attr("src",this.src='{{captcha_src()}}'+Math.random()); 
    };
    

    $(document).on('click','.captcha',function(){
        //图片的点击事件
        $("#im").empty();
        $("#im").append("<img src='{{captcha_src()}}'");
    });


    function login()
    {
        if(canLogin==0){
            return false;
        }
        var account = $('input[name=account]').val();
        var password = $("input[name=password]").val();
        var captcha = $("input[name=captcha]").val();

        var index = layer.load(2);

        $.ajax({
            type: "POST",
            url: "{{ URL::route('login.login')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                account: account,
                password: password,
                captcha: captcha
            },
            dataType: "json",
            success: function (msg) {
                layer.close(index);
                canLogin = 1;
                if (msg.status=="1") {
                    location.href = "{{ URL::route('index.index') }}";
                } else {
                    layer.msg(msg.msg);
                }
            },
            error : function (msg ) {
                layer.close(index);
                getPic();
                var json=JSON.parse(msg.responseText);
                if(json.errors.captcha[0]=='validation.captcha'){
                    layer.msg('图片验证码错误，请重新输入');
                }else{
                    $.each(json.errors, function(idx, obj) {
                        layer.msg(obj[0]);
                        return false;
                    });
                }
            },
        }, "json");
    }

</script>

</html>

