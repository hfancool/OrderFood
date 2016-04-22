<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel=stylesheet href='/Eatery/Public/tools/jqueryMobile/jquery.mobile-1.4.5.css'>
		<script src='/Eatery/Public/tools/jquery/jquery-1.7.2.min.js'></script>
		<script src='/Eatery/Public/tools/jqueryMobile/jquery.mobile-1.4.5.js'></script>
		<script type="text/javascript" src="/Eatery/Public/js/admin_login_success.js"></script>
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
							<img width="80px" height="80px" alt="" src="/Eatery/Public/img/1.jpg"/>
							<h7>当前点餐</h7>
						</a>
						<a data-icon="delete" ></a>
					</li>
					<li>
						<a href="javascript:;">
							<img width="80px" height="80px" alt="" src="/Eatery/Public/img/1.jpg"/>
							<h7>当前点餐</h7>
						</a>
						<a data-icon="delete" ></a>
					</li>
				</ul>
	  		</div>
	  
				<div data-role="footer" data-theme="e" data-position='fixed' data-fullscreen="true">
			     <div data-role="navbar">
			      <ul>
			        <li><a id="newfoods" href="#index" data-icon="home" class="ui-btn-active">当前订单</a></li>
			        <li><a id="myinfo" href="#myInfo" data-icon="info" >我的信息</a></li>
			      </ul>
			    </div>   
			  </div> 
		</div>
		<!-- 第二个页面 当管理员点击我的信息的时候的第二个页面-->
		<div data-role="page" id="myInfo">
			<!-- 头信息 -->
			<div data-role="header">
				 <h1 style="font-style: italic;font-weight: bold;">我&nbsp;的&nbsp;信&nbsp;息</h1>
			</div>
			<!-- 内容部分 -->
			<div data-role="content">
				<ul data-role="listview" data-inset="true">
					<!-- 我的基本信息 -->
					<li>
						<a href="javascript:;">
							<img width="80px" height="80px" alt="" src="/Eatery/Public/img/1.jpg"/>
							<h7>魏家凉皮</h7>
							<p>
								地址：mmmmmmmmmm
							</p>
						</a>
					</li>
					<li data-role="list-divider"></li>
					<!-- 我的菜单 -->
					<li>
						<a href="#MenuManage" style="font-weight: normal;">菜单管理</a>
					</li>
					<li>
						<a href="#PayManage" style="font-weight: normal;">支付管理</a>
					</li>
					<li>
						<a href="#HotSale" style="font-weight: normal;">热&nbsp;销&nbsp;榜</a>
					</li>
					<li>
						<a href="#HumenManage" style="font-weight: normal;">人员管理</a>
					</li>
					
					<li data-role="list-divider"></li>
					<!-- 退出登录 -->
					<li>
						<a href="javascript:;" data-role="button" style="font-size: 15px;">退出登录</a>
					</li>
				</ul>
			</div>
			<!-- 页脚部分 -->
			<div data-role="footer" data-theme="e" data-position="fixed" data-fullscreen="true">
				<div data-role="navbar">
					<ul>
						<li><a id="newfoods" href="#index" data-icon="home">当前订单</a></li>
				        <li><a id="myinfo" href="#myInfo" data-icon="info" class="ui-btn-active">我的信息</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- 我的信息页面的所有按钮的相关页面 -->
		<!-- 菜单管理页面 -->
		<div data-role="page" id="MenuManage">
			<!-- 头信息 -->
			<div data-role="header">
				<div data-role="navbar">
					<ul>
						<li>
							<a href="#myInfo" data-role="button" class="ui-btn-left ui-btn-corners">Back</a>
						</li>
					</ul>
				</div>
				<h1 style="font-style: italic;font-weight: bold;">菜&nbsp;单&nbsp;管&nbsp;理</h1>
			</div>
			<!-- 内容部分 -->
			<div data-role="content">
				
			</div>
			<!-- 尾部,添加菜单 -->
			<div data-role="footer" data-position="fixed" data-fullscreen="true">
				<div data-role="navbar">
					<ul>
						<li>
							<a href="javascript:;" data-role="button" data-iconpos="notext" data-icon="plus" style="font-size: 15px;"></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- 支付管理页面 -->
		<div data-role="page" id="PayManage">
			<!-- 头信息 -->
			<div data-role="header">
				<div data-role="navbar">
					<ul>
						<li>
							<a href="#myInfo" data-role="button" class="ui-btn-left ui-btn-corners">Back</a>
						</li>
					</ul>
				</div>
				<h1 style="font-style: italic;font-weight: bold;">支&nbsp;付&nbsp;管&nbsp;理</h1>
			</div>
			<!-- 内容部分 -->
		</div>		
		<!-- 热销榜页面 -->
		<div data-role="page" id="HotSale">
			<!-- 头信息 -->
			<div data-role="header">
				<div data-role="navbar">
					<ul>
						<li>
							<a href="#myInfo" data-role="button" class="ui-btn-left ui-btn-corners">Back</a>
						</li>
					</ul>
				</div>
				<h1 style="font-style: italic;font-weight: bold;">热&nbsp;&nbsp;销&nbsp;&nbsp;榜</h1>
			</div>
			<!-- 内容部分 -->
		
		</div>
		<!-- 人员管理页面 -->
		<div data-role="page" id="HumenManage">
			<!-- 头信息 -->
			<div data-role="header">
				<div data-role="navbar">
					<ul>
						<li>
							<a href="#myInfo" data-role="button" class="ui-btn-left ui-btn-corners">Back</a>
						</li>
					</ul>
				</div>
				<h1 style="font-style: italic;font-weight: bold;">人&nbsp;员&nbsp;管&nbsp;理</h1>
			</div>
			<!-- 内容部分 -->
			
		</div>
	</body>
</html>