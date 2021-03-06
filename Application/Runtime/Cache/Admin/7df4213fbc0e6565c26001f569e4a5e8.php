<?php if (!defined('THINK_PATH')) exit();?><form class="layui-form">
  <div class="layui-form-item">
    <label class="layui-form-label">输入框</label>
    <div class="layui-input-block">
      <input type="text" name="title"placeholder="请输入标题" autocomplete="off"  id="name" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">密码框</label>
    <div class="layui-input-inline">
      <input type="password" name="password"placeholder="请输入密码" autocomplete="off" id="pwd" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">辅助文字</div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">选择框</label>
    <div class="layui-input-block">
      <select name="city">
        <option value=""></option>
        <option value="0">北京</option>
        <option value="1">上海</option>
        <option value="2">广州</option>
        <option value="3">深圳</option>
        <option value="4">杭州</option>
      </select>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">复选框</label>
    <div class="layui-input-block">
      <input type="checkbox" name="like" title="写作" value="1">
      <input type="checkbox" name="like" title="阅读" value="2" checked>
      <input type="checkbox" name="like" title="发呆" value="3">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">开关</label>
    <div class="layui-input-block">
      <input type="checkbox" name="switch" lay-skin="switch">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">单选框</label>
    <div class="layui-input-block">
      <input type="radio" name="sex" value="男" title="男">
      <input type="radio" name="sex" value="女" title="女" checked>
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">文本域</label>
    <div class="layui-input-block">
      <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn subs" lay-submit lay-filter="formDemo" onclick="return false;">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn sub" lay-submit lay-filter="formDemo" onclick="return false;">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>
<script>
layui.use(['layer'], function() {
	var $ = layui.jquery;
	$('.sub').click(function(){
		layer.tips('这是最简单的','#pwd');
		return;
	})
	
	$('.subs').click(function(){
		var url = "<?php echo U('Index/form');?>";
		$.get(url,function(data){
			layer.open({
				  title:'提交表单',//设置弹窗层标题
				  type: 1,
				  skin: 'layui-layer-rim', //加上边框
				  area: ['800px'], //宽高
				  resize:true,//是否允许拉伸
				  content: data,
			});
		})
	})
})
</script>