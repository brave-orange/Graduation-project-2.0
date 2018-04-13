<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="/test/Public/plugins/layui/css/layui.css" media="all" />
		<link rel="stylesheet" href="/test/Public/css/main.css" />
	</head>

	<body>
		<div class="admin-main">
			<blockquote class="layui-elem-quote">
				<p><h2 style="font-size: large;font-weight: bold;"><?php echo session('user_info')['user_name']; ?>,您好！  您当前有 <asd style="font-size: 30px; color: red;"><?php echo ($exe_num); ?></asd> 个待执行任务，<asd style="font-size: 30px; color: red;"><?php echo ($check_num); ?></asd> 个待审核任务。</h2></p>
								
			</blockquote>
			<div style="margin: 0 auto;">
			<div style="width: 500px;height: 400px; float: left" id="exe"></div>
			<div style="width: 800px;height: 400px;margin-left:30px;float: left" id="execount"></div>

			</div>
			<fieldset class="layui-elem-field">
				<legend></legend>
				<div class="layui-field-box">
					<fieldset class="layui-elem-field layui-field-title">
						<legend>待执行任务：</legend>
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
								<?php if(is_array($exe_info)): foreach($exe_info as $k=>$vo): ?><tr>
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

										<td><?php echo ($vo["state"]); ?></td>
										<td>
											<a data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini layui-btn-normal edit"><i class="layui-icon">&#xe642;</i>接单</a>
											<a data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini layui-btn-normal edit"><i class="layui-icon">&#xe642;</i>反馈确认</a>
										</td>
									</tr><?php endforeach; endif; ?>

								</tbody>
							</table>
						</div>
					</fieldset>
					<fieldset class="layui-elem-field layui-field-title">
						<legend>待审核任务：</legend>
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
								<?php if(is_array($check_info)): foreach($check_info as $k=>$vo): ?><tr>
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

										<td><?php echo ($vo["state"]); ?></td>
										<td>
											<a data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini layui-btn-normal edit"><i class="layui-icon">&#xe642;</i>审核</a>

										</td>
									</tr><?php endforeach; endif; ?>
								</tbody>
							</table>
						</div>
					</fieldset>
				</div>
			</fieldset>

		</div>
		<script type="text/javascript" src="/test/Public/Echars/echarts.common.min.js"></script>
		<script type="text/javascript" src="/test/Public/plugins/jquery-1.9.1.min.js"></script>
		<script type="text/javascript">
			var myChart = echarts.init(document.getElementById('exe'))
            var myChart1 = echarts.init(document.getElementById('execount'))
            option = {
                title : {
                    text: '工作量分布',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: ['我创建任务数','我执行任务数','我审核任务数']
                },
                series : [
                    {
                        name: '完成量',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }


                    }

                ]
            };
            option1 = {
                title: {
                    text: '折线图堆叠'
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data:['邮件营销','联盟广告','视频广告','直接访问','搜索引擎']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: ['周一','周二','周三','周四','周五','周六','周日']
                },
                yAxis: {
                    type: 'value'
                },
                series: [
                    {
                        name:'邮件营销',
                        type:'line',
                        stack: '总量',
                        data:[120, 132, 101, 134, 90, 230, 210]
                    },
                    {
                        name:'联盟广告',
                        type:'line',
                        stack: '总量',
                        data:[220, 182, 191, 234, 290, 330, 310]
                    },
                    {
                        name:'视频广告',
                        type:'line',
                        stack: '总量',
                        data:[150, 232, 201, 154, 190, 330, 410]
                    },
                    {
                        name:'直接访问',
                        type:'line',
                        stack: '总量',
                        data:[320, 332, 301, 334, 390, 330, 320]
                    },
                    {
                        name:'搜索引擎',
                        type:'line',
                        stack: '总量',
                        data:[820, 932, 901, 934, 1290, 1330, 1320]
                    }
                ]
            };
            myChart1.setOption(option1);

                $.post('getSbWorkinfo',{'uid':'<?php echo $_SESSION["user_info"]["id"]; ?>'},function(data){


                    option.series[0].data = data
					console.log(option)
                    myChart.setOption(option);

                })



		</script>
	</body>
</html>