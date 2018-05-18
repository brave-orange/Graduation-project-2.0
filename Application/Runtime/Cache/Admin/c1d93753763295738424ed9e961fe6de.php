<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Table</title>
    <link rel="stylesheet" href="/Public/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/Public/plugins/css/mine.css"  media="all">
    <link rel="stylesheet" href="/Public/css/global.css" media="all">
    <link rel="stylesheet" href="/Public/plugins/font-awesome/css/font-awesome.min.css">

</head>

<body>
<div class="admin-main">
    <h2 style="font-size: 25px;font-weight: bolder;margin-left: 50px;margin-top :20px;margin-bottom: 20px;">我的异常任务</h2>
    <hr class="hr">
	<fieldset class="layui-elem-field">
				<legend></legend>
				<div class="layui-field-box">
					<fieldset class="layui-elem-field layui-field-title">
						<legend>被拒接任务：</legend>
						<div class="layui-field-box">
							<table class="layui-table">
								<thead>
								<tr>
									<th>#</th>
									<th>任务Id</th>
									<th>所属工单</th>
									<th>任务摘要</th>
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
								<?php if(is_array($data1)): foreach($data1 as $k=>$vo): ?><tr>
										<td><?php echo ($k+1); ?></td>
										<td><?php echo ($vo["id"]); ?></td>
										<td><?php echo ($vo["tid"]); ?></td>
										<td><?php echo ($vo["title"]); ?></td>
										<td><?php echo ($vo["createid"]); ?></td>
										<td><?php echo ($vo["exeid"]); ?></td>
										<td><?php echo ($vo["checkid"]); ?></td>
										<td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
										<?php if(($vo["level"] == 1)): ?><td style="background-color: #4CAF50;">低</td>
											<?php elseif($vo["level"] == 2): ?>
											<td style="background-color: #F7B824;">中</td>
											<?php else: ?>
											<td style="background-color: red;">高</td><?php endif; ?>

										<td><?php if(($vo["state"] == 0)): ?>未接单
											<?php elseif($vo["state"] == 1): ?>
											已接单
											<?php elseif($vo["state"] == 2): ?>
											被拒接
											<?php elseif($vo["state"] == 3): ?>
											待审核
											<?php elseif($vo["state"] == 4): ?>
											审核未通过
											<?php elseif($vo["state"] == 5): ?>
											已完成<?php endif; ?></td>
										<td>
											<a data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini layui-btn-normal again"><i class="layui-icon">&#xe642;</i>重发</a>
											<a  data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-danger layui-btn-mini del"><i class="layui-icon">&#xe640;</i>删除</a>

										</td>
									</tr><?php endforeach; endif; ?>
								</tbody>
							</table>
						</div>
					</fieldset>
				</div>
			</fieldset>
			<fieldset class="layui-elem-field">
				<legend></legend>
				<div class="layui-field-box">
					<fieldset class="layui-elem-field layui-field-title">
						<legend>审核未通过任务：</legend>
						<div class="layui-field-box">
							<table class="layui-table">
								<thead>
								<tr>
									<th>#</th>
									<th>任务Id</th>
									<th>所属工单</th>
									<th>任务摘要</th>
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
								<?php if(is_array($data2)): foreach($data2 as $k=>$vo): ?><tr>
										<td><?php echo ($k+1); ?></td>
										<td><?php echo ($vo["id"]); ?></td>
										<td><?php echo ($vo["tid"]); ?></td>
										<td><?php echo ($vo["title"]); ?></td>
										<td><?php echo ($vo["createid"]); ?></td>
										<td><?php echo ($vo["exeid"]); ?></td>
										<td><?php echo ($vo["checkid"]); ?></td>
										<td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
										<?php if(($vo["level"] == 1)): ?><td style="background-color: #4CAF50;">低</td>
											<?php elseif($vo["level"] == 2): ?>
											<td style="background-color: #F7B824;">中</td>
											<?php else: ?>
											<td style="background-color: red;">高</td><?php endif; ?>

										<td><?php if(($vo["state"] == 0)): ?>未接单
											<?php elseif($vo["state"] == 1): ?>
											已接单
											<?php elseif($vo["state"] == 2): ?>
											被拒接
											<?php elseif($vo["state"] == 3): ?>
											待审核
											<?php elseif($vo["state"] == 4): ?>
											审核未通过
											<?php elseif($vo["state"] == 5): ?>
											已完成<?php endif; ?></td>
										<td>
											<a data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini layui-btn-normal back"><i class="layui-icon">&#xe642;</i>重新确认</a>
											<a  data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-danger layui-btn-mini del"><i class="layui-icon">&#xe640;</i>删除</a>

										</td>
									</tr><?php endforeach; endif; ?>
								</tbody>
							</table>
						</div>
					</fieldset>
				</div>
			</fieldset>
    
</div>
    <script type="text/javascript" src="/Public/plugins/layui/layui.js"></script>
    <script type="text/javascript" src="/Public/plugins/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
	layui.use('form', function() {
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
        $('.again').click(function(){
        	var task_id = $(this).attr('data');
            var url = "<?php echo U('Task/tryagain');?>";
            layer.confirm('确定重发吗?', {
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
        $('.back').click(function(){
        	var task_id = $(this).attr('data');
            var url = "<?php echo U('Task/backagain');?>";
            layer.confirm('确定重新提交审核吗?', {
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
    })
</script>
</body>

</html>