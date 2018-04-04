<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>工单管理系统</title>
    <link type="text/css" rel="stylesheet" href="/Public/mine/css/login.css" />
    <link rel="stylesheet" href="/Public/layui/css/layui.css"  media="all">

</head>

<body class="body">
<div class="div">
    <form id="form" class="layui-form" method="POST" action="login/login" >
        <div class="layui-form-item">
            <p class="title">工单管理系统登陆</p>
            <p class="login">登录验证</p>
            <div><input type="text" id="userid" name="userid" lay-verify="title" autocomplete="off" placeholder="账号" class="layui-input"></div><br>
            <div><input type="password" id="password" name="password" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input"></div>
            <div class="btn-down">
                <button type = "button" class="layui-btn layui-btn-normal layui-btn-radius" onclick="login() "  lay-submit="" lay-filter="demo1">马上登录</button>
                <a href="register">注册账号</a>
            </div>

        </div>
    </form>
</div>


<script src="/Public/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/Public/mine/js/jquery-1.9.1.min.js"></script>
<script>
    layui.use(['form', 'layedit', 'laydate'], function(){
        var form = layui.form
            ,layer = layui.layer
            ,layedit = layui.layedit
            ,laydate = layui.laydate;

        //日期
        laydate.render({
            elem: '#date'
        });
        laydate.render({
            elem: '#date1'
        });

        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');

        //自定义验证规则
        form.verify({
            title: function(value){
                if(value.length<5){
                    return '用户名不为空至少得5个字符啊';
                }
            }

        });
    });
    function login()
    {
        if($("#userid").val()!=""&&$("#password").val()!="") {
            if ($("#userid").val().length > 1) {

                $.post("login/login",
                    {
                        userid: $("#userid").val(),
                        password: $("#password").val()
                    },
                    function (data) {
                        if (data == "fail") {
                            layer.alert('用户名或密码错误！', {
                                title: '登录失败'
                            })
                            $('#form1')[0].reset()
                        }
                        else {
                            $(window).attr('location', './admin/index.html');
                        }
                    });
            }
        }
    }

    $('#form').keyup(function(event){

        if(event.keyCode === 13){    //按下enter键
            login();
        }
    });
</script>


</body>
</html>