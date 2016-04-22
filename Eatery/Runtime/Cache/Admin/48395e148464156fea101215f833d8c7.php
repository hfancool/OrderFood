<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel=stylesheet href='/Eatery/Public/tools/jqueryMobile/jquery.mobile-1.4.5.css'>
		<script src='/Eatery/Public/tools/jquery/jquery-1.7.2.min.js'></script>
		<script src='/Eatery/Public/tools/jqueryMobile/jquery.mobile-1.4.5.js'></script>
		<script type="text/javascript" src="/Eatery/Public/js/admin_login.js"></script>
		<title>基本的页面</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

	</head>
	<body>
		<div data-role="page">
		
			<!-- 头信息 -->
			<div data-role="header" > 
				  <h1 style="font-style: italic;font-weight: bold;">后&nbsp;台&nbsp;登&nbsp;陆</h1>
			</div> 
			<!-- 内容 -->
			<div data-role="content">
	    		
			 	<form action="./test" method="post"> 
					<div class="ui-field-contain">
						<label for="userName">用户名：</label>
						<input id="userName" type="text" name="userName">
					</div>
					<div class="ui-field-contain">
						<label for="psw">密码：</label>
						<input id="psw" type="password" name="psw">
					</div>

					<div>
						<input id="admin_login" type="button" value="登 &nbsp;&nbsp;录" style="background-color: black;">
					</div>
			 	</form> 
	  		</div>
		</div>
	</body>
</html>