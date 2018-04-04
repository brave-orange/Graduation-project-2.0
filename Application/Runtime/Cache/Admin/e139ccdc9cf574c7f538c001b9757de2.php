<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户注册</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link type="text/css" rel="stylesheet" href="/Public/mine/css/login.css" />
    <link rel="stylesheet" href="/Public/layui/css/layui.css"  media="all">

</head>
<body>

<div class="div">
    <form id="form1" class="layui-form" method="post" action="register/register" >
    <div class="layui-form-item">
        <p class="title">工单管理系统</p>
        <p class="login">用户注册</p>
        <div><input type="text" id="userid" name="userid" lay-verify="title" autocomplete="off" placeholder="账号至少三个字符" class="layui-input"></div><br>
        <div><input type="text" id="name" name="name" lay-verify="required" autocomplete="off" placeholder="昵称" class="layui-input"></div><br>
        <div><input type="text" id="phone" name="phone" lay-verify="phone" autocomplete="off" placeholder="手机号" class="layui-input"></div><br>
        <div><input type="password" id="password" name="password" lay-verify="pass" placeholder="请输入密码" autocomplete="off" class="layui-input"></div>
        <div><input type="password" id="password2" name="password" lay-verify="repass" placeholder="再次输入密码" autocomplete="off" class="layui-input"></div>
        <div class="btn-down">
            <button id="submit" type="submit"  class="layui-btn layui-btn-normal layui-btn-radius"    lay-submit="" lay-filter="demo1">马上注册</button>

        </div>
    </div>
    </form>

</div>


<script src="/Public/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/Public/mine/js/jquery-1.9.1.min.js"></script>

<script>

    $("#userid").change(function(){
        $.post("login/isRepeat",
            {
                userid:$("#userid").val()
            },
            function(data){
                if(data == "no")
                {

                    layer.alert('此用户名已被注册过！',{
                        title: '警告'
                    })
                    $('#userid').val( "")
                }

            });
    });
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
            title: function(value, item){ //value：表单的值、item：表单的DOM对象
                if(value.length < 5){
                    return '用户名至少得5个字符啊';
                }
                if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                    return '用户名不能有特殊字符';
                }
                if(/(^\_)|(\__)|(\_+$)/.test(value)){
                    return '用户名首尾不能出现下划线\'_\'';
                }
                if(/^\d+\d+\d$/.test(value)){
                    return '用户名不能全为数字';
                }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value) {
                var repassvalue = $('#password').val();
                if (value != repassvalue) {
                    return '两次输入的密码不一致!';
                }
            }


        });
        $('#form1').keyup(function(event){

            if(event.keyCode === 13){    //按下enter键
                $('#submit').onclick()
            }
        });



    });
</script>

</body>
</html>