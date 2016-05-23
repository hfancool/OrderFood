/*点击菜单列表时触发事件*/
$(function(){
    /*当页面加载时检查订单*/
    check_order();
    var time = 10000;
    window.setInterval('check_order()',time);
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
/*检查当前的订单*/
function check_order(){
    $.get('./show_order', function (data) {
        var html='';
        $.each(data,function(key,val){
                html += "<li class='ui-li-has-alt ui-first-child'>";
                html += "<a href='javascript:;' class='ui-btn'>";
                html += "<h7>订单号:"+key+"</h7>";
                $.each(val,function(k,v){
                    html += " <p>菜名："+v.menu_name+" 单价："+v.price+"元/份 数量："+v.num+"份</p>";
                })
                html += " </a>";
            /*bug 修复，当字符串首位为0的时候自动将该字符串转换为八进制的数字，容易出错*/
                html += " <a data-icon='delete' href='javascript:complete_order("+key.replace(/\b(0+)/gi,"")+");'  class='ui-btn ui-btn-icon-notext ui-icon-delete'></a>";
                html += " </li>";
        });
        $('#order_list').html(html);
    });
}
/*订单完成时点击删除订单时将memcached 中的数据删除*/
function complete_order(order_id){
    $.get('./complete_order',{'order_id':order_id},function(data){
        if(data.code == 200){
            message("订单已完成");
            /*在此处可以加入声音提示信息*/
            $('#audio_order').attr({
                src:data.audio
            });
            check_order();
        }else{
            message('订单删除失败');
        }
    });
}

