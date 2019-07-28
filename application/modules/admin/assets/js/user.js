/**
 * Created by Phuong PC on 2/25/2016.
 */
var userObj = {
    changeStatus : function(url){
        //alert('change status '+ url);
        $.post(url, '', function(data,status) {
            //console.log(status);
        });
    }
}