<?php if (!defined('THINK_PATH')) exit();?>
<form class="layui-form"enctype="multipart/form-data">
    <h2 style="margin-left: 20px;color:#1E9FFF;font-weight: bolder;font-size: 20px;margin: 20px;"><?php echo ($task["name"]); ?></h2>
<!--    <?php if($state == 0 ): ?>已创建未接单   //判断订单状态画上对应图标
        <?php else: ?> 已接单<?php endif; ?>-->
    <input type="text" name = "work_id" value="<?php echo ($work_info["id"]); ?>" style="display: none">
    <div class="layui-form-item">
        <label class="layui-form-label">创建人</label>
        <div class="layui-input-inline">
            <input type="text" name="user_id" value="<?php echo ($work_info["createid"]); ?>" style="display: none">
            <input type="text" style="width: 250px;"  name="user_name" lay-verify="required" placeholder="请输入用户名" id="name" value="<?php echo ($user["user_name"]); ?>" readonly="readonly" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">选择审核人</label>
        <div class="layui-input-inline">
            <select name="checkid" id = "checkid" >
                <?php if(is_array($user_info)): $i = 0; $__LIST__ = $user_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($vo["id"]); ?>"><?php echo ($vo["user_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">选择执行人</label>
        <div class="layui-input-inline">
            <select name="exeid" id = "exeid">
                <?php if(is_array($user_info1)): $i = 0; $__LIST__ = $user_info1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($vo["id"]); ?>"><?php echo ($vo["user_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <?php if(is_array($form_data)): $i = 0; $__LIST__ = $form_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="layui-form-item">
            <label class="layui-form-label"><?php echo ($vo["title"]); ?></label>
            <div class="layui-input-inline">
                <?php if(($vo["type"] == 0)): ?><input type="text" style="width: 250px;" name="<?php echo ($vo["ziduan"]); ?>" lay-verify="required" placeholder="请输入<?php echo ($vo["title"]); ?>" id="<?php echo ($vo["ziduan"]); ?>"   class="layui-input">
                    <?php elseif($vo["type"] == 1): ?>
                    <textarea style="height: 70px; width: 250px;" name="<?php echo ($vo["ziduan"]); ?>" lay-verify="required"  id="<?php echo ($vo["ziduan"]); ?>"   class="layui-input"></textarea>
                    <?php else: ?>
                    <input type="file" style="width: 250px;"  name="<?php echo ($vo["ziduan"]); ?>" lay-verify="required"  id="<?php echo ($vo["ziduan"]); ?>"   class="layui-input"><?php endif; ?>
            </div>
            </if>

        </div><?php endforeach; endif; else: echo "" ;endif; ?>

    <div class="layui-form-item" style="margin-top: 50px;"id="sub">
        <div class="layui-input-block">
            <button class="layui-btn"  lay-submit lay-filter="task" style="margin-left: 30px;"  lay-submit lay-filter="user">立即提交</button>
            <button type="reset" id="btn" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script>

    layui.use('form', function(){

        var form = layui.form(),
            $ = layui.jquery
        //监听提交
        form.on('submit(task)', function(data){
            var state = '<?php echo ($work_info["state"]); ?>'
            if(state != 0)
            {
                layer.alert('此任务已被接单，为了安全起见无法操作！', {
                    title: '警告'
                })

            }else
                {
                    var workInfo = data.field;
                    var url = "updateWorks";
                    $.post(url, workInfo, function (data) {
                        if (data.status == 'error') {
                            layer.msg(data.msg, {icon: 5});//失败的表情
                            return;
                        } else if (data.status == 'success') {
                            layer.msg(data.msg, {
                                icon: 6,//成功的表情
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            }, function () {
                                location.reload();
                            });
                        }
                    })
                }
            return false;//阻止表单跳转
        });
        $(function () {
            $('#btn').click();
            var a = "<?php echo $_SESSION['user_info'][id]; ?>"
            var b = "<?php echo ($work_info["createid"]); ?>"
            var eid = "<?php echo ($work_info["exeid"]); ?>"
            var chid = "<?php echo ($work_info["checkid"]); ?>"
            var formdata = '<?php echo ($work_info["data"]); ?>'
            var jsondata= formdata.replace("\\", "/");
            var jsonform = $.parseJSON(jsondata);
           // console.log(jsonform)
            for(var key in jsonform)
            {
                $('#'+key).val(jsonform[key])
            }


            $('#checkid').val(chid)
            $('#exeid').val(eid)


            if(a != b)
            {
                layer.msg("您不是本工单的创建人，无法编辑此工单！",{icon: 5});
                $('#sub').hide()
            }

        });
    })
</script>