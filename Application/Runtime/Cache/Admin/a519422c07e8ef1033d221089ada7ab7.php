<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/test/Public/plugins/layui/css/layui.css" media="all" />
</head>
<body>
            
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>设定上传文件的格式</legend>
</fieldset>
 
<input type="file" name="file" class="layui-upload-file"> 
<input type="file" name="file1" lay-type="file" class="layui-upload-file"> 
<input type="file" name="file1" lay-type="audio" class="layui-upload-file"> 
<input type="file" name="file2" lay-type="video" class="layui-upload-file"> 
<blockquote class="layui-elem-quote" style="margin-top: 20px;">支持拖动文件上传</blockquote>
 
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
  <legend>演示上传</legend>
</fieldset>
 
<div class="site-demo-upload" style="position:relative">
  <img id="img_upload" src="http://layer.layui.com/images/tong.jpg" style="width: 200px;height: 200px;border-radius: 100%;">
  <div class="site-demo-upbar" style="position:absolute;top: 50%;left: 6%;margin: -18px 0 0 -56px;">
    <input type="file" name="file" class="layui-upload-file" id="test" >
  </div>
</div>
 
<p style="margin-top: 20px;">注：由于服务器资源有限，所以此处每次给你返回的是同一张图片</p>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
  <legend>自定义文本</legend>
</fieldset>
 
<input type="file" name="file" class="layui-upload-file" lay-title="添加一个碉堡了的图片"> 
 
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
  <legend>保留原始风格</legend>
</fieldset>
 
<input type="file" name="file">
 
<blockquote class="layui-elem-quote" style="margin-top: 20px;">即不改变input的样式，只提供上传功能</blockquote>               
          
<script type="text/javascript" src="/test/Public/plugins/layui/layui.js"></script>
<script>
layui.use('upload', function(){
  layui.upload({
    url: '' //上传接口
    ,success: function(res){ //上传成功后的回调
      console.log(res)
    }
  });
  
  layui.upload({
    url: "<?php echo U('Index/upload');?>"
    ,title: '上传赛事图片'
    ,elem: '#test' //指定原始元素，默认直接查找class="layui-upload-file"
    ,ext: 'jpg|png|gif|jpeg'
    ,method: 'post' //上传接口的http类型
    ,success: function(res){
      if(res.status == 'error'){
    	  layer.msg(res.msg);
      }else{
    	  img_upload.src = res.url;
      }
    }
  });
});
</script>

</body>
</html>