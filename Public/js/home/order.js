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
    $('#buy').click(function () {
    //    TODO
    });
})
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
        alert(data.code);
    })
}