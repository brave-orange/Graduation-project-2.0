<?php if (!defined('THINK_PATH')) exit();?>
<form class="layui-form"  id = "recive-form"enctype="multipart/form-data">
    <h2 style="margin-left: 20px;color:#1E9FFF;font-weight: bolder;font-size: 20px;margin: 20px;"><?php echo ($work_info["taskname"]); ?></h2>
    <!--    <?php if($state == 0 ): ?>已创建未接单   //判断订单状态画上对应图标
            <?php else: ?> 已接单<?php endif; ?>-->
    <div id="inputs">
    <input type="text" name = "work_id" value="<?php echo ($work_info["id"]); ?>" style="display: none">
    <div class="layui-form-item">
        <label class="layui-form-label">创建人</label>
        <div class="layui-input-inline">
            <input type="text" style="width: 250px;"  name="user_name" lay-verify="required" placeholder="请输入用户名" id="name" value="<?php echo ($work_info["createname"]); ?>" readonly="readonly" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">审核人</label>
        <div class="layui-input-inline">
            <select name="checkid" id = "checkid" disabled="disabled">
                <input type="text" style="width: 250px;"  name="check_name" lay-verify="required" placeholder="请输入用户名" id="checkname" value="<?php echo ($work_info["checkname"]); ?>" readonly="readonly" class="layui-input">
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">执行人</label>
        <div class="layui-input-inline">
            <input type="text" style="width: 250px;"  name="exe_name" lay-verify="required" placeholder="请输入用户名" id="exename" value="<?php echo ($work_info["exename"]); ?>" readonly="readonly" class="layui-input">
        </div>
    </div>
    <?php if(is_array($form_data)): $i = 0; $__LIST__ = $form_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="layui-form-item">
            <label class="layui-form-label"><?php echo ($vo["title"]); ?></label>
            <div class="layui-input-inline">
                <?php if(($vo["type"] == 0)): ?><input type="text" style="width: 250px;" name="<?php echo ($vo["ziduan"]); ?>" lay-verify="required" placeholder="请输入<?php echo ($vo["title"]); ?>" id="<?php echo ($vo["ziduan"]); ?>"  readonly="readonly" class="layui-input">
                    <?php elseif($vo["type"] == 1): ?>
                    <textarea style="height: 70px; width: 250px;" name="<?php echo ($vo["ziduan"]); ?>" lay-verify="required"  id="<?php echo ($vo["ziduan"]); ?>" readonly="readonly"  class="layui-input"></textarea>
                    <?php else: ?>
                    <input type='text' name="<?php echo ($vo["ziduan"]); ?>"  id="<?php echo ($vo["ziduan"]); ?>" onchange="loadimg('<?php echo ($vo["ziduan"]); ?>',this.value)" value="" style="display: none;">
                    <img style="height:80px;width:80px;display: block;" id="<?php echo ($vo["ziduan"]); ?>1"><?php endif; ?>
            </div>
            </if>

        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div id="dialog_show" style="display: none;">
        <div class="layui-form-item">
            <label class="layui-form-label">拒接理由</label>
            <div class="layui-input-inline">
                <input type="text" style="width: 250px;"   placeholder="请输入拒绝理由" id="goaway1"  class="layui-input">
            </div>
        </div>
    </div>

    <div class="layui-form-item" style="width:300px;"id="sub">
        <div style="margin-left:150px;">
            <button type="button" class="layui-btn"  lay-filter="task" id="recive"  lay-filter="user">接单</button>
            <button type="button" id="goaway" class="layui-btn">拒接</button>
        </div>
    </div>
</form>

<script>

    layui.use('form', function(){

        var form = layui.form(),
            $ = layui.jquery
        $(function () {
            var a = "<?php echo $_SESSION['user_info'][id]; ?>"
            var b = "<?php echo ($work_info["createname"]); ?>"
            var eid = "<?php echo ($work_info["exename"]); ?>"
            var chid = "<?php echo ($work_info["checkname"]); ?>"
            var formdata = '<?php echo ($work_info["data"]); ?>'
            var jsondata = formdata.replace("\\", "/");
            var jsonform = $.parseJSON(jsondata);
            // console.log(jsonform)
            for (var key in jsonform) {
                $('#' + key).val(jsonform[key]).change();
                
            }


            $('#checkid').val(chid)
            $('#exeid').val(eid)
        })
        $('#recive').click(function(){
            var workid = "<?php echo ($work_info["id"]); ?>"
            console.log(workid)
            var url = "<?php echo U('Task/recive');?>";
                $.post(url,{'workid':workid},function(data) {
                    if(data.status == 'error'){
                        layer.msg(data.msg,{icon: 5,time: 2000});//失败的表情
                        return;
                    }else {
                        layer.msg(data.msg, {
                            icon: 6,//成功的表情
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                            location.reload();
                        })
                    }
                })


        })
        $('#goaway').click(function(){
            if($('#dialog_show').attr("style") == "display: none;")
            {
                $('#dialog_show').css({ "display": "block" })
                $('#dialog_show').attr({"lay-verify":"required"})
            }
            if($('#goaway1').val() != ""){
                var url = "<?php echo U('Task/goback');?>"
                var reson = $('#goaway1').val()
                var workid = "<?php echo ($work_info["id"]); ?>"
                $.post(url,{'workid':workid,'reson':reson},function(data){
                    if(data.status == 'error'){
                        layer.msg(data.msg,{icon: 5,time: 2000});//失败的表情
                        return;
                    }else {
                        layer.msg(data.msg, {
                            icon: 6,//成功的表情
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function () {
                            location.reload();
                        })
                    }
                })
            }

        })
        $("img").click(function(){
                var src = this.src
                console.log(src)
                var data = "<img src=\""+src+"\" style=\"height:100%;width:100%\">"
                layer.open({
                    title:'图片预览',
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['400px','400px'], //宽高
                    content: data,
        });
    });


    })
    

    function loadimg(name,url){
        var name1 = name+'1';
        $('#'+name1).attr('src',url)
    }
</script>