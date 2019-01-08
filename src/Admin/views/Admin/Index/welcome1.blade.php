<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/style/css/bootstrap.min.css?v=3.3.7" rel="stylesheet">
    <link href="/style/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/style/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/style/css/animate.min.css" rel="stylesheet">
    <link href="/style/css/style.css?v=4.0.0" rel="stylesheet"><base target="_blank">
    <link href="/style/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12" style="    padding-left: 50px; padding-top: 50px;">
            <div class="ibox float-e-margins">
                <div class="page-wrap" >
                    <div class="page-wrap">
                        <div class="flow-layout">
                            <div class="panel-item">

                                <a href="###" target="_self" style="background-color: #f9b13f;height: 120px;">
                                    <label></label>
                                    <div class="num"></div>
                                </a>
                                <a href="###" target="_self" style="background-color: #FFD811;height: 120px;">
                                    <label></label>
                                    <div class="num"></div>
                                </a>
                                <a href="###" target="_self" style="background-color: #f9b23f;height: 120px;">
                                    <label></label>
                                    <div class="num"></div>
                                </a>

                                <a href="###" target="_self" style="background-color: #add078;height: 120px;">
                                    <label></label>
                                    <div class="num"></div>
                                </a>

                            </div>
                        </div>
                        <style>
                            .flow-layout .panel-item{
                                width: 105%;
                                overflow: hidden;
                            }
                            .flow-layout .panel-item a{
                                float: left;
                                display: block;
                                width: 18%;
                                margin-right: 50px;
                                margin-bottom: 38px;
                                padding: 18px 30px;
                                color: #FFF;
                                box-shadow: 0px 0px 20px rgba(0,0,0,.1);
                                transition: all 450ms ease;
                                text-decoration: none;
                            }
                            .flow-layout .panel-item a:hover{
                                box-shadow: 0px 8px 20px rgba(0,0,0,.2);
                            }
                            .flow-layout .panel-item a label{
                                font-size: 18px;
                            }
                            .flow-layout .panel-item a .num{
                                font-size: 30px;
                                width: 100%;
                                text-align: center;
                                margin-top: 8px;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="picker" style="display: none;"></div>
<script src="/style/js/jquery.min.js?v=2.1.4"></script>
<script src="/style/js/bootstrap.min.js?v=3.3.7"></script>
<script src="/style/js/content.min.js?v=1.0.0"></script>
<script src="/style/layer/layer.js"></script>
<script src="/style/js/plugins/iCheck/icheck.min.js"></script>
<script src="/style/js/plugins/wangEditor/release/wangEditor.js"></script>
<link rel="stylesheet" type="text/css" href="/style/js/plugins/dater/flatpickr.min.css">
<script src="/style/js/plugins/dater/flatpickr.min.js"></script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>
</html>