var Page = {
    /*默认每页大小*/
    pageSize:10,
    /*当前页面*/
    nowpage:1,
    url:'',
    flag:true,
    data:'',
    /*上一页*/
    Prev: function (callback) {
        if(this.nowpage == 1){
            return;
        }
        this.nowpage -= 1;
        $.ajax({
            type:'POST',
            url :this.url,
            data:{page:this.nowpage,pageSize:this.pageSize},
            success: function (data) {
                this.data=data;
                if(callback != undefined){
                    callback(this.data);
                }
            }
        });
    },
    /*下一页*/
    Next: function ( callback) {
        if(this.flag == false){
            return;
        }
        this.nowpage+=1;
        $.ajax({
            type:'POST',
            url :this.url,
            data:{page:this.nowpage,pageSize:this.pageSize},
            success: function (data) {
                if(data.bd.length =0){
                    this.flag = false;
                    return;
                }
                if(callback != undefined){
                    callback(data);
                }
            }
        });
    }
}