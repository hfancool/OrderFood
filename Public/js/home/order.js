$(function(){
    $('#points').change(function(){
        var num = $('#points').val();
        var price = $('#price').val();
        var total = price + "元/份 * "+num+"份 ="+(num * price)+"元";
        $('#total_pay').val(total);
    });
})