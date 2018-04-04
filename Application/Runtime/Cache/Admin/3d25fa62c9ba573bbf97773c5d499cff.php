<?php if (!defined('THINK_PATH')) exit();?><form class="layui-form">
  <div class="layui-form-item">
    <label class="layui-form-label">用户名</label>
    <div class="layui-input-inline">
      <input type="text" name="user_name" lay-verify="title" placeholder="请输入用户名" autocomplete="off"  id="name" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">联系电话</label>
    <div class="layui-input-inline">
      <input type="text" name="phone" lay-verify="phone" placeholder="请输入联系电话" autocomplete="off"  id="phone" class="layui-input">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">登录密码</label>
    <div class="layui-input-inline">
      <input type="password" name="password" lay-verify="pass" placeholder="请输入密码" autocomplete="off" id="pwd" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">再次输入密码</label>
    <div class="layui-input-inline">
      <input type="password" name="password1" lay-verify="repass" placeholder="请再次输入密码" autocomplete="off" id="pwd1" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="user">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>
<script>

layui.use('form', function(){
	var form = layui.form(),
   		 $ = layui.jquery
        ,layer = layui.layer
	  //监听提交
	  form.on('submit(user)', function(data){
		  
	    var userInfo = data.field;
	    console.log(data)
	    
		var url = "<?php echo U('User/addUser');?>";
		$.post(url,userInfo,function(data){
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
      form.verify({
          title: function(value, item){ //value：表单的值、item：表单的DOM对象
              if(value.length < 5){
                  return '用户名至少得5个字符啊';
              }
              if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                  return '用户名不能有特殊字符';
              }
              if(/(^\_)|(\__)|(\_+$)/.test(value)){
                  return '用户名首尾不能出现下划线\'_\'';
              }
              if(/^\d+\d+\d$/.test(value)){
                  return '用户名不能全为数字';
              }
          }
          ,pass: [/(.+){6,12}$/, '密码必须6到12位']
          ,repass: function(value) {
              var repassvalue = $('#pwd').val();
              if (value != repassvalue) {
                  return '两次输入的密码不一致!';
              }
          }


      });
      });
      $("#name").change(function() {

          $.post("<?php echo U('User/isRepeat');?>",
              {
                  name: $("#name").val()
              },
              function (data) {
                  if (data == "no") {

                      layer.alert('此用户名已被注册过！', {
                          title: '警告'
                      })
                      $('#name').val("")
                  }

              });
      });
     /* $("#pwd1").change(function() {

          if($('#pwd1').val() != $('#pwd').val())
          {
              layer.alert('两次密码输入不一致！', {
                  title: '警告'
              })
              $('#pwd1').val("")
              $('#pwd').val("")

          }

      });*/

</script>