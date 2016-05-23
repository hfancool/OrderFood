$(function(){
    /*当用户选择当前点餐时的数量时，动态的算出应结算总金额显示给客户*/
    $('#points').change(function(){
        var num = $('#points').val();
        var price = $('#price').val();
        var total = price + "元/份 * "+num+"份 ="+(num * price)+"元";
        $('#total_pay').val(total);
    });

    /*监听添加到购物车按钮被点击*/
    $('#category').click(function(){
        $("form").submit();
    });
    /*去下单按钮添加监听*/
    //$('#go_buy').click(function () {
    ////    TODO
    //});
})
/*当用户点击下单按钮的时候触发该事件*/
//function go_buy(){
//    var menu_id     = $('#menu_id').val();
//    var menuname    = $('#menuname').val();
//    var price       = $('#price').val();
//    var total_num   = $('#points').val();
//    var image       = $('#image').attr('src');
//    var data = 'menu_id='+menu_id+'&menuname='+menuname+'&price='+price+'&num='+total_num+'&image='+image;
//    $.ajax({
//        url : './category',
//        type: 'POST',
//        data: data,
//        success:function(data){
//            //alert(data);
//            if(data == 1){
//                message("宝贝已添加到购物车中!");
//            }else{
//                message("无法添加!");
//            }
//        }
//    });
//}
/*当用户点击添加到购物车的时候*/
function category(){
    /*通过ajax的方式将数据添加到购物车中*/
    var menu_id     = $('#menu_id').val();
    var menuname    = $('#menuname').val();
    var price       = $('#price').val();
    var total_num   = $('#points').val();
    var image       = $('#image').attr('src');
    var data = 'menu_id='+menu_id+'&menuname='+menuname+'&price='+price+'&num='+total_num+'&image='+image;
    $.ajax({
        url : './category',
        type: 'POST',
        data: data,
        success:function(data){
            //alert(data);
            if(data == 1){
                message("宝贝已添加到购物车中!");
            }else{
                message("无法添加!");
            }
        }
    });
}
/*清空购物车*/
function clean_category(){
    $.get("./clean_category",function(){
        window.location.reload();/*刷新页面*/
    });
}
/*根据menu_id号删除购物车中的数据*/
function remove_category(menu_id,num){
    $.get('./remove_category',{'menu_id':menu_id,'num':num},function(data){
        if(data == 1){
            message("购物车暂无数据")
        }
        window.location.reload();/*刷新页面*/
    });
}
/*处理订单*/
function order(){
    $.get('./order_food', function (data) {
        if(data.code == 200){
            /*如果下单成功，则将购物车中的物品清空*/
            $.get("./clean_category");
            message("下单成功，请等待...",1000);
            /*清空购物车*/
            var html='';
                html += "<li class='ui-li-has-alt ui-first-child'>";
                html += "<a href='javascript:;' class='ui-btn'>";
                html += "<h7>下单成功，订单号："+data.order_id+"</h7>";
                html += " </a>";
                html += " </li>";
            $('#category_info').html(html);
            var order_pre_id = '';
            if($.cookie('order_id') != undefined){
                order_pre_id=$.cookie('order_id');
            }
            /*下单成功后，将订单在cookie中存储24分钟*/
            var date = new Date();
            date.setTime(date.getTime() + ( 24 * 60 * 1000));/*24分钟*/
            $.cookie('order_id',order_pre_id+data.order_id+' |  ',{
                expires:date,
                path:'/'
            });
            if($.cookie('order_id') != undefined){
                $('#complate_order_id').html("已完成订单号:\r\n"+ $.cookie('order_id'));
            }else{
                $('#complate_order_id').html("暂无订单");
            }
        }else{
            message(data.message);
        }
    })
}