$(function(){
	//用户密码框聚焦
	$('#userName').focus();
    /*检测用户是否点击了回车按钮*/
    $("body").keyup(function (event) {
        if(event.keyCode == 13){
            $("#admin_login").click();
        }
    })
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
			$.post("./admin_login",{userName:$("#userName").val(),psw:$("#psw").val()},function(data){
                if(data){
                    if(data.code == 200){
                        window.location.href="./admin_login_success";
                    }
                    if(data.code == 400){
                        window.alert(data.message);
                    }
                }
			});

		}
	});
});