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
                <select>
                    <option value ="">请选择</option>
                    <div class="layui-input-inline">
                    <?php if(is_array($user_info)): $i = 0; $__LIST__ = $user_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($vo["id"]); ?>"><?php echo ($vo["user_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </select>
            </div>

            <label class="layui-form-label">执行人：</label>
            <div class="layui-input-inline">
                <select>
                    <option value ="">请选择</option>
                    <?php if(is_array($user_info)): $i = 0; $__LIST__ = $user_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($vo["id"]); ?>"><?php echo ($vo["user_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>

            <label class="layui-form-label">审核人：</label>
            <div class="layui-input-inline">
                <select>
                    <option value ="">请选择</option>
                    <?php if(is_array($user_info)): $i = 0; $__LIST__ = $user_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($vo["id"]); ?>"><?php echo ($vo["user_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <button class="layui-btn" lay-submit lay-filter="task" style="margin-left: 30px;"  lay-submit lay-filter="user">查看</button>
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
                    <td><?php echo ($vo["changeid"]); ?></td>
                    <td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
                    <td><?php echo ($vo["state"]); ?></td>
                    <td>
                        <a data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini layui-btn-normal edit"><i class="layui-icon">&#xe642;</i>编辑</a>
                        <a  data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-danger layui-btn-mini del"><i class="layui-icon">&#xe640;</i>删除</a>
                        <a data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini role"><i class="layui-icon">&#xe608;</i>分配角色</a>
                        <a data="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini worktype"><i class="layui-icon">&#xe608;</i>绑定工种</a>
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


        })
    </script>

</body>
</html>