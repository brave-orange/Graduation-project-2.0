<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Table</title>
    <link rel="stylesheet" href="/test/Public/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/test/Public/css/global.css" media="all">
    <link rel="stylesheet" href="/test/Public/plugins/font-awesome/css/font-awesome.min.css">

</head>

<body>
<div class="admin-main">


    <fieldset class="layui-elem-field">
        <legend>工单列表</legend>
        <div class="layui-field-box">
            <table class="layui-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>工单ID</th>
                    <th>工单名称</th>
                    <th>创建时间</th>
                    <th>完成量</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($task_list)): foreach($task_list as $k=>$vo): ?><tr>
                        <td><?php echo ($k+1); ?></td>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>
                        <td><?php echo (date("Y-m-d H:i:s",$vo["createtime"])); ?></td>
                        <td><?php echo ($vo["count"]); ?></td>
                        <td>
                            <a  data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini layui-btn-normal send"><i class="layui-icon">&#xe618;</i> 派发</a>
                            <a  data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-danger layui-btn-mini del"><i class="layui-icon">&#xe640;</i> 删除</a>
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>

        </div>
    </fieldset>
    <div class="admin-table-page">
        <div id="page" class="page">
            <?php echo ($page); ?>
        </div>
    </div>
</div>
<script type="text/javascript" src="/test/Public/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/test/Public/plugins/jquery-1.9.1.min.js"></script>
<script>
    layui.use(['laypage','layer','form'], function() {
        var laypage = layui.laypage,
            $ = layui.jquery
        //请求表单
        $('.add').click(function(){

        });
        //派发
        $('.send').click(function(){
            var task_id = $(this).attr('data');
            var url = "<?php echo U('Task/SendTask');?>";
            $.post(url,{'task_id':task_id},function(data){
                if(data.status == 'error'){
                    layer.msg(data.msg,{icon: 5});
                    return;
                }
                layer.open({
                    title:'派发工单',
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['500px'], //宽高
                    content: data,
                });
            })
        });


        //删除
        $('.del').click(function(){
            var task_id = $(this).attr('data');
            var url = "<?php echo U('Task/deleteTask');?>";
            layer.confirm('确定删除吗?', {
                icon: 3,
                skin: 'layer-ext-moon',
                btn: ['确认','取消'] //按钮
            }, function(){
                $.post(url,{'task_id':task_id},function(data){
                    if(data.status == 'error'){
                        layer.msg(data.msg,{icon: 5});//失败的表情
                        return;
                    }else{
                        layer.msg(data.msg, {
                            icon: 6,//成功的表情
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            location.reload();
                        });
                    }
                })
            });
        })

    });
</script>
</body>

</html>