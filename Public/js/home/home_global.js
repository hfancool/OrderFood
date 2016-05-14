$(function () {

});
/*加载显示框*/
function showLoader(){
    $.mobile.loading('show', {
        text: '加载中...', //加载器中显示的文字
        textVisible: true, //是否显示文字
        theme: 'a',        //加载器主题样式a-e
        textonly: true,   //是否只显示文字
        html: ""           //要显示的html内容，如图片等
    });
}
/*加载页面时的影藏框*/
function hideLoader(){
    $.mobile.loading('hide');
}
/*菜单加入到购物车中的提示信息*/
function message(message){

    $.mobile.loading('show', {
        text: message, //加载器中显示的文字
        textVisible: true, //是否显示文字
        theme: 'a',        //加载器主题样式a-e
        textonly: true,   //是否只显示文字
        html: ""           //要显示的html内容，如图片等
    });
    var time = 1000;/*提示信息消失时间*/
    this.setTimeout("hideLoader()",time);/*定时任务*/
}


