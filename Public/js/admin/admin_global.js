/*点击菜单列表时触发事件*/
$(function(){
    /*文件上传框样式*/
    $(".file").on("change","input[type='file']",function(){
        var filePath=$(this).val();
        if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1){
            $(".fileerrorTip").html("").hide();
            var arr=filePath.split('\\');
            var fileName=arr[arr.length-1];
            $(".showFileName").html(fileName);
        }else{
            $(".showFileName").html("");
            $(".fileerrorTip").html("您未上传文件，或者您上传文件类型有误！").show();
            return false
        }
    });

})
function editMenu(){
    $("#menuname").focus();
    $("#btn_edit").css({display:"none"});
    $("#btn_sub").css({display:"block"});
    $("#menuname").attr({readonly:false});
    $("#price").attr({readonly:false});
    $("#desc").attr({readonly:false});
    $(".file").css({display:"block"});
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
