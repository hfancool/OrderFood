$(function () {
    /*控制订单完成后语音提示次数*/
    var time=1;
    $('audio').on('ended', function(){
        time=time+1;
        if(time>3){
            $(this).paused = true;
            time=1;
        }else{
            $(this).load();
        }
    });
});
