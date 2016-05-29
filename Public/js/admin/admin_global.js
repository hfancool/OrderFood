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
/*信息提示*/
function message(message,new_time){
    var time = 1000;/*提示信息消失时间*/
    if(new_time != undefined){
        time = new_time;
    }
    $.mobile.loading('show', {
        text: message, //加载器中显示的文字
        textVisible: true, //是否显示文字
        theme: 'a',        //加载器主题样式a-e
        textonly: true,   //是否只显示文字
        html: ""           //要显示的html内容，如图片等
    });
    this.setTimeout("hideLoader()",time);/*定时任务*/
}
/*加载页面时的影藏框*/
function hideLoader(){
    $.mobile.loading('hide');
}
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
    $.get('../Index/show_order', function (data) {
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
/*用户等级编辑功能*/
function level_edit(id,level_id){
    $('#name'+id).attr({readonly:false});
    $('#salary'+id).attr({readonly:false});
    $('#name'+id).focus();
    /*将编辑按钮改为确定按钮*/
    $('#btn1'+id).html("<div class='ui-btn ui-input-btn ui-corner-all ui-shadow'>确定<input type='button' onclick='level_update("+id+","+level_id+");' value='确定'></div>");
}
/*用户等级更新*/
function level_update(id,level_id){
    /*获取更新后表单中的值*/
    var level_name = $('#name'+id).val();
    var salary     = $('#salary'+id).val();
    /*通过ajax的方式修改level表中的数据*/
    $.get('./edit_level',{'level_name':level_name,'salary':salary,'level_id':level_id}, function (data) {
        if(data.code == 200){
            message('更新成功');
            $('#name'+id).attr({readonly:true});
            $('#salary'+id).attr({readonly:true});
            $('#btn1'+id).html("<div class='ui-btn ui-input-btn ui-corner-all ui-shadow'>编辑<input type='button' onclick='level_edit("+id+","+level_id+");' value='编辑'></div>");
        }else{
            alert(data.message);
        }
    })
}
/*删除该用户等级*/
function del_level(level_id){
    if(!confirm('您将要删除该条记录，确认该操作吗')){
        return;
    }
    $.get('./del_level',{'level_id':level_id},function(data){
        if(data.code == 200){
            message('操作成功');
            window.location.reload();
        }else{
            message('操作失败');
        }
    });
}
/*添加用户等级*/
function add_level(){
    var level_id   = $('#level_id').val();
    var level_name = $('#level_name').val();
    var salary     = $('#salary').val();
    if(level_id == ''){
        message('用户等级不能为空');
        return ;
    }
    if(level_name == ''){
        message('等级名称不能为空');
        return;
    }
    if(salary == ''){
        message('基本薪资不能为空');
        return;
    }

    /*将新建等级提交*/
    $.get('./insert',{'level_id':level_id,'level_name':level_name,'salary':salary}, function (data) {
        if(data.code == 400){
            alert(data.message)
            message(data.message);
        }else if(data.code ==200){
            message('添加成功');
            window.location.href="./index";
        }
    });
}
/*添加用户*/
function add_employee(){
    var level_id = $('#level_id').val();
    var username = $('#username').val();
    var sex      = $("input[type='radio']:checked").val();
    var birthday = $('#birthday').val();
    var mobile   = $('#mobile').val();
    $.post('./insert',{'level_id':level_id,'username':username,'sex':sex,'birthday':birthday,'mobile':mobile}, function (data) {
        if(data.code == 200){
            message('雇员添加成功');
            window.location.href='./index';
        }else{
            message('雇员添加失败');
        }
    });
}
/*删除雇员*/
function del_employee(eid){
    if(eid == '' || eid == undefined){
        message('请选择要删除的雇员');
        return;
    }
    if(!confirm('您将会删除该雇员')){
        return;
    }
    $.get('./del_employee',{'eid':eid}, function (data) {
        if(data.code == 200){
            message('雇员删除成功');
            window.location.reload();
        }else{
            message('雇员删除失败');
        }
    });
}

/*雇员考勤*/
function violation(eid){
    /*将雇员的考勤添加到数据库中，按月考勤*/
    var att = $("input[name='attendence']:checked").val();/*员工的出勤状况*/
    var vio = $("#violation").val();
    $.get('./violation',{'eid':eid ,'att':att,'vio':vio}, function (data) {
        if(data.code == 200){
            message('考勤成功');
            window.setTimeout('window.history.back()',1000);
        }else{
            message(data.message);
        }
    });
}

/*导出考勤记录*/
function exportVio(){
    alert(111);
    $.get('',{}, function (data) {

    });
}