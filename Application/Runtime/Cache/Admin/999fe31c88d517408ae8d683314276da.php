<?php if (!defined('THINK_PATH')) exit();?>
<form id="form1" class="layui-form" enctype="multipart/form-data">
        <h2 style="margin-left: 20px;color:#1E9FFF;font-weight: bolder;font-size: 20px;margin: 20px;"><?php echo ($task["name"]); ?></h2>
    <input type="text" name = "task_id" value="<?php echo ($task["id"]); ?>" style="display: none">
    <div class="layui-form-item">
        <label class="layui-form-label">创建人</label>
        <div class="layui-input-inline">
            <input type="text" name="user_id" value="<?php echo session('user_info')['id']; ?>" style="display: none">
            <input type="text" style="width: 250px;"  name="user_name" lay-verify="required" placeholder="请输入用户名" id="name" value="<?php echo session('user_info')['user_name']; ?>" readonly="readonly" class="layui-input">
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
            <select name="exeid" id = "">
                <?php if(is_array($user_info1)): $i = 0; $__LIST__ = $user_info1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value ="<?php echo ($vo["id"]); ?>"><?php echo ($vo["user_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">优先级</label>
        <div class="layui-input-inline">
            <select name="level" id = "exeid">
                    <option value ="1" selected>低</option>
                    <option value ="2">中</option>
                    <option value ="3">高</option>
            </select>
        </div>
    </div>

    <?php if(is_array($task_info)): $i = 0; $__LIST__ = $task_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="layui-form-item">
            <label class="layui-form-label"><?php echo ($vo["title"]); ?></label>
            <div class="layui-input-inline">
                <?php if(($vo["type"] == 0)): ?><input type="text" style="width: 250px;" name="<?php echo ($vo["ziduan"]); ?>" lay-verify="required" placeholder="请输入<?php echo ($vo["title"]); ?>" id="<?php echo ($vo["ziduan"]); ?>"   class="layui-input">
                <?php elseif($vo["type"] == 1): ?>
                    <textarea style="height: 70px; width: 250px;" name="<?php echo ($vo["ziduan"]); ?>" lay-verify="required"  id="<?php echo ($vo["ziduan"]); ?>"   class="layui-input"></textarea>
                <?php else: ?>
                    <input type="file" style="width: 250px;" class="layui-upload-file" accept="image/png, image/jpeg, image/gif, image/jpg" name="<?php echo ($vo["ziduan"]); ?>1" id="upload1">
                     <input type='text' name="<?php echo ($vo["ziduan"]); ?>"  id="<?php echo ($vo["ziduan"]); ?>" value="" style="display: none;">

                    <img class="layui-upload-img"  style="height:80px;width:80px;display: none;" id="<?php echo ($vo["ziduan"]); ?>1"><?php endif; ?>
            </div>
            </if>

        </div><?php endforeach; endif; else: echo "" ;endif; ?>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="task" style="margin-left: 30px;"  lay-submit lay-filter="user">立即提交</button>
            <button type="reset" id="btn" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>

</form>
<!-- <script type="text/javascript" src="/Public/mine/js/jquery.form.min.js"></script> -->

<script>

    layui.use('form', function(){

        var form = layui.form(),
            $ = layui.jquery
        //监听提交
        
        form.on('submit(task)', function(data){
            var taskInfo = data.field;
            console.log(data)

            var url = "addTask";
            $.post(url,taskInfo,function(data){
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

            return false;//阻止表单跳转
        });

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


    });
    layui.use('upload', function(){
      layui.upload({
        url: '' //上传接口
        ,success: function(res){ //上传成功后的回调
          console.log(res)
        }
      });
      
      layui.upload({
        url: "<?php echo U('Task/upload');?>"
        ,title: '上传文件'
        ,elem: '#upload1' //指定原始元素，默认直接查找class="layui-upload-file"
        ,ext: 'jpg|png|gif|jpeg'
        ,method: 'post' //上传接口的http类型
        ,success: function(res){
          if(res.status == 'error'){
              layer.msg(res.msg);
          }else{
              var s = res.name
              s=s.substring(0,s.length-1);
              $('#'+s).val(res.url) 
              $('#'+res.name).attr('src',res.url)
              $('#'+res.name).css('display','block')
              console.log($('#'+s).val())

          }
        }
      });
    });

    $(function () {
        $('#btn').click();

       /* a = " <?php echo session('task_id');?>"

        $.post("<?php echo U('Task/getTaskInfo');?>",{'task_id':a},function(data){
            var jsonstr =eval(data);
        })*/
    })
</script>