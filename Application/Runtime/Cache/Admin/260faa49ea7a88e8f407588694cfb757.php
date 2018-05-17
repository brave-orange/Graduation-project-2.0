<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>
<link rel="stylesheet" href="/Public/plugins/css/mine.css"  media="all">
<link rel="stylesheet" href="/Public/plugins/layui/css/layui.css" media="all" />
<script src="/Public/plugins/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/Public/plugins/jquery-1.9.1.min.js"></script>

<script type="text/javascript">
    layui.use(['layer'], function() {
        layer = layui.layer;
    });

    function add()
    {
        var a ="<div class='div2'>项目名：<input type='text'  name='pname'  autocomplete='off' class='pname' placeholder='请填写项目名称' > <label>标签名：</label> <select name='type' class='type'> <option value='0'>文本框</option> <option value='1'>多行文本</option> <option value='2'>上传文件</option> </select>对应数据库字段名：<input type='text' name='ziduan' class='ziduan' autocomplete='off' placeholder='请填写项目名称'> </div> <br>"
        $('#form').append(a)
    }
    function getdata(){
        if($('.tname').val()=="" || $('.gname').val()=="" || $('.pname').val()=="")
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
            var json_str = '[',i=0
            $(a).each(function(){
                json_str += '{"title":"'+this+'","body":'+b[i]+',"ziduan":"'+c[i]+'"},'
                i+=1
            })
            json_str = json_str.substr(0,json_str.length-1);
            json_str += ']'



            var url = "<?php echo U('Task/AddTaskType');?>";
            var s = []
            //s['data'] = json_str

            $.post(url,{'data':json_str,'table_name':$('.tname').val(),'task_name':$('.gname').val()},function(data){
                if(data.status == 'error'){
                    layer.msg(data.msg,{icon: 5});//失败的表情
                    return;
                }else if(data.status == 'success'){
                    layer.msg(data.msg, {
                        icon: 6,//成功的表情
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        location.reload();
                    });
                }
            })
        }
    }
    window.onload = function(){

        layer.open({
            type: 1
            ,title: false //不显示标题栏
            ,closeBtn: false
            ,area: '300px;'
            ,shade: 0.8
            ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
            ,btn: ['好的，我记住了']
            ,btnAlign: 'c'
            ,moveType: 1 //拖拽模式，0或者1
            ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;"><h4>使用功能请注意以下几点：</h4><ul><li>点击一下“添加项目”按钮便可添加一行输入框</li><li>请不要留空</li><li>字段名和表名务必合理!!!</li></ul></div>'

        });
/*        $('#tname').change(function() {

            var myReg = /^[a-zA-Z0-9_]{0,}$/
            if (!myReg.test($('.tname').val())) {
                layer.msg("表名不能包含中文！",{icon: 5})
                $('.tname').val("")
            }
        });*/
    };


</script>
<body>

<h2 style="margin-left: 30px; font-size: 30px;margin-top: 30px;font-weight: bolder;">新建工单类型</h2>
<hr class="hr">
<div class="div1">
    <form id="form" class="" method="" action="" >

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
    <!--表名：<input type="text" name="tname" class="tname" id="tname" placeholder="请填写数据表名称(不包含前缀)"></input>-->
    工单标题：<input type="text" name="pname" class="gname" placeholder="请填写工单标题"></input>

</div>
</body>
</html>