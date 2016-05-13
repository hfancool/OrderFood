/*点击菜单列表时触发事件*/
function editMenu(){
    $("#menuname").focus();
    $("#btn_edit").css({display:"none"});
    $("#btn_sub").css({display:"block"});
    $("#menuname").attr({readonly:false});
    $("#price").attr({readonly:false});
    $("#desc").attr({readonly:false});
    $("#image").after("<input type='file' name='image'>");
}

/*删除菜单列表中的记录*/
function removeMenu(menu_id){
    var url = "./removeMenu"
    if(confirm("确认删除")){
        $.ajax({
            type: "GET",
            url: url,
            data: "menu_id="+menu_id,
            success: function(msg){
                if(msg == 1){
                    window.location.href="./index";
                }else{
                    window.alert("数据删除失败");
                }
            }


        });
    }
    return false;
}
