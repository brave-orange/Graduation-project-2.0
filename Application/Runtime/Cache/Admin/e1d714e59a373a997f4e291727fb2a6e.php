<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Table</title>
    <link rel="stylesheet" href="/test/Public/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/test/Public/plugins/css/mine.css"  media="all">
    <link rel="stylesheet" href="/test/Public/css/global.css" media="all">
    <link rel="stylesheet" href="/test/Public/plugins/font-awesome/css/font-awesome.min.css">

</head>
<body>
<fieldset class="layui-elem-field">
    <form class="layui-form">
        <h2 style="font-size: 25px;font-weight: bolder;margin-left: 50px;margin-top :20px;margin-bottom: 20px;">任务列表</h2>
        <hr class="hr">
        <div class="layui-form-item">
            <label class="layui-form-label">创建人：</label>
            <div class="layui-input-inline">
                <select name="createid">
                    <option value ="">请选择</option>
                    <div class="layui-input-inline">
                    <?php if(is_array($user_info)): $i = 0; $__LIST__ = $user_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($vo["id"]); ?>"><?php echo ($vo["user_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </select>
            </div>

            <label class="layui-form-label">执行人：</label>
            <div class="layui-input-inline">
                <select name="exeid">
                    <option value ="">请选择</option>
                    <?php if(is_array($user_info)): $i = 0; $__LIST__ = $user_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($vo["id"]); ?>"><?php echo ($vo["user_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>

            <label class="layui-form-label">审核人：</label>
            <div class="layui-input-inline">
                <select name="checkid">
                    <option value ="">请选择</option>
                    <?php if(is_array($user_info)): $i = 0; $__LIST__ = $user_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($vo["id"]); ?>"><?php echo ($vo["user_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>

            <label class="layui-form-label">任务状态：</label>
            <div class="layui-input-inline">
                <select name="state">
                    <option value ="">请选择</option>
                    <option value ="0">未接单</option>
                    <option value ="1">已接单</option>
                    <option value ="2">被拒接</option>
                    <option value ="3">待审核</option>
                    <option value ="4">未完成</option>
                    <option value ="5">已完成</option>
                </select>
            </div>
            <button class="layui-btn" lay-submit lay-filter="look" style="margin-left: 30px;"  lay-submit lay-filter="user">查看</button>
            <button type="reset" id="btn" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </form>
    </fieldset>

<fieldset class="layui-elem-field">

    <div class="layui-field-box">
        <table class="layui-table">
            <thead>
            <tr>
                <th>#</th>
                <th>任务Id</th>
                <th>所属工单</th>
                <th>创建人</th>
                <th>执行人</th>
                <th>审核人</th>
                <th>创建时间</th>
                <th>优先级</th>
                <th>当前状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($data)): foreach($data as $k=>$vo): ?><tr>
                    <td><?php echo ($k+1); ?></td>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["tid"]); ?></td>
                    <td><?php echo ($vo["createid"]); ?></td>
                    <td><?php echo ($vo["exeid"]); ?></td>
                    <td><?php echo ($vo["checkid"]); ?></td>
                    <td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
                    <?php if(($vo["level"] == 1)): ?><td style="background-color: #4CAF50;">低</td>
                        <?php elseif($vo["level"] == 2): ?>
                        <td style="background-color: #F7B824;">中</td>
                        <?php else: ?>
                        <td style="background-color: red;">高</td><?php endif; ?>

                    <td>

                        <?php if(($vo["state"] == 0)): ?>未接单
                        <?php elseif($vo["state"] == 1): ?>
                            已接单
                        <?php elseif($vo["state"] == 2): ?>
                            被拒接
                        <?php elseif($vo["state"] == 3): ?>
                            待审核
                        <?php elseif($vo["state"] == 4): ?>
                            未完成
                        <?php elseif($vo["state"] == 5): ?>
                            已完成<?php endif; ?>
                    </td>
                    <td>
                        <a data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini layui-btn-normal edit"><i class="layui-icon">&#xe642;</i>编辑</a>
                        <a  data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-danger layui-btn-mini del"><i class="layui-icon">&#xe640;</i>删除</a>

                    </td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>

    </div>
</fieldset>
    <script type="text/javascript" src="/test/Public/plugins/layui/layui.js"></script>
    <script type="text/javascript" src="/test/Public/plugins/jquery-1.9.1.min.js"></script>
    <script>
        $(function () {
            $('#btn').click();

        })

        layui.use('form', function() {
            var form = layui.form(),
                $ = layui.jquery
            form.on('submit(look)', function(data){
                var taskInfo = data.field;

                var url = "taskList";
                console.log(taskInfo);
                $.get(url,taskInfo,function(data){

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

                //return false;//阻止表单跳转
            });

        })
        $('.del').click(function(){
            var task_id = $(this).attr('data');
            var url = "<?php echo U('Task/deleteWorks');?>";
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
                });
        })
        })
        $('.edit').click(function(){
            var work_id = $(this).attr('data');
            var url = "<?php echo U('Task/EditWork');?>";
            $.post(url,{'work_id':work_id},function(data){
                if(data.status == 'error'){
                    layer.msg(data.msg,{icon: 5});
                    return;
                }
                layer.open({
                    title:'编辑任务',
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['500px'], //宽高
                    content: data,
                });
            })
        })


    </script>

</body>
</html>