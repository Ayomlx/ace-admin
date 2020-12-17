<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=1200,initial-scale=1.0"/>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="edge" />
<base href="<?php echo ($site["WEB_ROOT"]); ?>"/>
<title>后台管理系统</title>
<base href="<?php echo ($site["WEB_ROOT"]); ?>"/>
<link rel="stylesheet" type="text/css" href="/Public/Css/pop_status.css" />
<link rel="stylesheet" type="text/css" href="<?php echo ($site["WEB_ROOT"]); ?>Public/Min/?f=/Public/Admin/Css/login.css" />
<link rel="stylesheet" type="text/css" href="/Public/Js/asyncbox/skins/default.css" />
<script type="text/javascript" src="/Public/Js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="/Public/Js/pop_status.js"></script>
<script type="text/javascript" src="/Public/Js/functions.js"></script>
<script type="text/javascript" src="/Public/Js/jquery.form.js"></script>
<script type="text/javascript" src="/Public/Js/asyncbox/asyncbox.js"></script>
</head>

<body class="loginpage">
<div class="loginbox">
  <div class="loginboxinner">
    <div class="logo">
      <h1 class="logo">后台管理系统</h1> </div>

      <form id="form1" action="" method="post">
      <div class="username">
        <div class="usernameinner">
          <input name="account" type="text" id="account" placeholder="请输入用户名" maxlength="30" />
        </div>
      </div>
      <div class="password">
        <div class="passwordinner">
          <input name="pwd" type="password" id="pwd"  placeholder="请输入密码" maxlength="30" />
        </div>
      </div>
      <input type="hidden" name="op_type" id="op_type" value="1"/>
      </form>
      <button class="btn submit">登录</button>
  </div>
</div>
<script type="text/javascript">
	$(function(){
		$(document).keydown(function(event){ 
			if(event.keyCode==13){ 
				$(".submit").click(); 
			}
		});
		$(".submit").click(function(){
			$("#op_type").val("1");
			if($("#account").val()==''||$("#pwd").val()==''){
				popup.alert("填写完整方可登陆");
				return false;
			}
			commonAjaxSubmit('','','',function(){
            });
		});
	});
</script>
</body>
</html>