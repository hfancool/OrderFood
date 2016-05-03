<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel=stylesheet href='/OrderFood/Public/tools/jqueryMobile/jquery.mobile-1.4.5.css'>
		<script src='/OrderFood/Public/tools/jquery/jquery-1.7.2.min.js'></script>
		<script src='/OrderFood/Public/tools/jqueryMobile/jquery.mobile-1.4.5.js'></script>
		<script type="text/javascript" src="/OrderFood/Public/js/admin/admin_global.js"></script>
		<script type="text/javascript" src="/OrderFood/Public/js/admin/admin_login_success.js"></script>
		<title>基本的页面</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
	<!-- 第一个页面 也是首页面 当管理员进入时的默认页面-->
		<div data-role="page" id="index">

			<!-- 头信息 -->
			<div data-role="header"> 
				  <h1 style="font-style: italic;font-weight: bold;">当&nbsp;前&nbsp;订&nbsp;单</h1>
			</div> 
			<!-- 内容 -->
			<div data-role="content">
	    		<!-- 当前的点餐列表 -->
				<ul data-role="listview" data-inset="true">
					<li>
						<a href="javascript:;">
							<img width="80px" height="80px" alt="" src="/OrderFood/Public/img/1.jpg"/>
							<h7>当前点餐</h7>
						</a>
						<a data-icon="delete" ></a>
					</li>
					<li>
						<a href="javascript:;">
							<img width="80px" height="80px" alt="" src="/OrderFood/Public/img/1.jpg"/>
							<h7>当前点餐</h7>
						</a>
						<a data-icon="delete" ></a>
					</li>
				</ul>
	  		</div>
	  
				<div data-role="footer" data-theme="e" data-position='fixed' data-fullscreen="true">
			     <div data-role="navbar">
			      <ul>
			        <li><a  href="javascript:;" data-icon="home" class="newfoods ui-btn-active">当前订单</a></li>
			        <li><a class="myinfo" href="javascript:admin_info();" data-icon="info" >我的信息</a></li>
			      </ul>
			    </div>   
			  </div> 
		</div>
	</body>
</html>