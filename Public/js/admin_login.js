$(function(){
	//用户密码框聚焦
	$('#userName').focus();
	//当用户点击登录按钮的时候，处理相应的业务逻辑
	$('#admin_login').click(function(){
		if($('#userName').val()==''){
			window.alert('用户名不能为空');
			$('#userName').focus();
		}else if($('#psw').val()==''){
			window.alert('密码不能为空');
			$('#psw').focus();
		}else{
			//以post的方式提交表单
			$.post("./admin_login",{userName:"fanhang",psw:"111"},function(data){
				window.alert(data);
			});
		}
	});

});