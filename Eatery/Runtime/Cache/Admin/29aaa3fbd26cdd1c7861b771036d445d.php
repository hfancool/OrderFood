<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel=stylesheet href='/OrderFood/Public/tools/jqueryMobile/jquery.mobile-1.4.5.css'>
		<script src='/OrderFood/Public/tools/jquery/jquery-1.7.2.min.js'></script>
		<script src='/OrderFood/Public/tools/jqueryMobile/jquery.mobile-1.4.5.js'></script>
		<script type="text/javascript" src="/OrderFood/Public/js/admin/admin_global.js"></script>
		<script type="text/javascript" src="/OrderFood/Public/js/home/home_global.js"></script>
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
				<ul data-role="listview" data-inset="true" id="order_list">
                    <?php if(is_array($order)): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
						<a href="javascript:;">
							<h7>订单号:<?php echo ($key); ?></h7>
                            <?php if(is_array($vo)): $k = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><p>菜名：<?php echo ($v["menu_name"]); ?> 单价：<?php echo ($v["price"]); ?>元/份 数量：<?php echo ($v["num"]); ?>份</p><?php endforeach; endif; else: echo "" ;endif; ?>
						</a>
						<a data-icon="delete" href="javascript:complete_order(<?php echo ($key); ?>);"></a>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
	  		</div>
	  
				<div data-role="footer" data-theme="e" data-position='fixed' data-fullscreen="true">
			     <div data-role="navbar">
			      <ul>
			        <li><a  href="javascript:;" data-icon="home" class="newfoods ui-btn-active" data-ajax="false">当前订单</a></li>
			        <li><a class="myinfo" href="./admin_my_info" data-icon="info">我的信息</a></li>
			      </ul>
			    </div>   
			  </div> 
		</div>
	</body>
</html>