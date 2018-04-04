<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加自定义工单</title>
</head>
<link rel="stylesheet" href="/Public/mine/css/mine.css"  media="all">
<link rel="stylesheet" href="/Public/layui/css/layui.css"  media="all">
<script type="text/javascript" src="/Public/mine/js/jquery-1.9.1.min.js"></script>
<script src="/Public/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.use(['form', 'layedit', 'laydate'], function() {
    });
    function add()
    {
        var a ="<div class='div2'>项目名：<input type='text'  name='pname'  autocomplete='off' class='pname' placeholder='请填写项目名称' > <label>标签名：</label> <select name='type' class='type'> <option value='0'>文本框</option> <option value='1'>多行文本</option> <option value='2'>上传文件</option> </select>对应数据库字段名：<input type='text' name='ziduan' class='ziduan' autocomplete='off' placeholder='请填写项目名称'> </div> <br>"
        $('#form').append(a)
    }
    function getdata(){
        if($('.tname').val()=="" && $('.gname').val()=="")
        {
            layer.msg('请将数据填写完整<br>务必填写完整！！！', {
                time: 20000, //20s后自动关闭
                btn: ['明白了']
            });
        }else {
            var a = [], b = [], c = []
            $('.pname').each(function () {
                a.push($(this).val())
            })
            $('.type').each(function () {
                b.push($(this).val())
            })
            $('.ziduan').each(function () {
                c.push($(this).val())
            })

            console.log(JSON.stringify(a), JSON.stringify(b), JSON.stringify(c))
        }

    }

</script>
<body>

<h2 style="margin-left: 30px; font-size: 30px;margin-top: 30px;font-weight: bolder;">新建工单类型</h2>
    <hr class="hr">
<div class="div1">
<form id="form" class="" method="POST" action="" >

<!--
        <div class="div2">
            项目名：<input type="text"  name="pname"  autocomplete="off" class="pname" placeholder="请填写项目名称" >
        <label>标签名：</label>
        <select name="type" class="type">

            <option value="0">文本框</option>
            <option value="1">多行文本</option>
            <option value="2">上传文件</option>
        </select>
        对应数据库字段名：<input type="text" name="ziduan" class="ziduan" autocomplete="off" placeholder="请填写字段名称" >
        </div>-->

</form>
</div>
<div class="btnarea">

<button class="addbtn" onclick="add()">添加项目</button>
<button class="addbtn1" onclick="getdata()">完成提交</button>
    表名：<input type="text" name="tname" class="tname" placeholder="请填写表名称"></input>
    工单标题：<input type="text" name="pname" class="gname" placeholder="请填写工单标题"></input>
</div>
</body>
</html>