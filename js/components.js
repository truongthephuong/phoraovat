
/**
 * Created by Phuong PC on 8/23/2016.
 */
var comObj = {
    changeStatus : function(url){
        //alert('change status');
        $.post(url, '', function(data) { });
    },
    edit : function(url){
        //alert('change status');
        $.post(url, '', function(data) { });
    },
    changeRank : function(id,rank,table){
        //alert($('#elRank'+id).html());
        var curEl = $('#elRank'+id).html();
        var newEl = '<input class="edit-icon" type="text" style="width: 30px" value="'+rank+'" id="newRank">';
        newEl += '<a href="#" onclick="comObj.updateRank('+id+',';
        newEl += '\''+table+'\'';
        newEl += ')"><i class="edit-icon glyphicon glyphicon-ok"></i></a>';
        newEl += '<a href="#" onclick="comObj.removeEl('+id+','+rank+')"><i class="edit-icon glyphicon glyphicon-remove"></i></a>';
        $('#elRank'+id).html('');
        $('#elRank'+id).html(newEl);
    },
    removeEl : function(id,rank){
        var curEl = '<a href="#" id="'+id+'" onclick="comObj.changeRank('+id+','+rank+')" title="change order of component"><b>'+rank+'</b></a>';
        $('#elRank'+id).html('');
        $('#elRank'+id).html(curEl);
    },
    updateRank : function(id,tbName){
        //alert(tbName);return false;
        var newRank = $('#newRank').val();
        var url = 'admin/changeRank/'+id+'/rank/'+newRank+'/'+tbName;
        var newEl = '<a href="#" id="'+id+'" onclick="comObj.changeRank('+id+','+newRank+')" title="change order of component"><b>'+newRank+'</b></a>';
        //alert(url);return false;
        $.post(url, '', function(data,status) {
            alert(data);
            $('#elRank'+id).html('');
            $('#elRank'+id).html(newEl);
        });
    },
    changeCategory : function(url){
        if (url != '') {
            //$('#category').on('change', function(event) {
                $('#loadingsearch').show();
                //alert($('#category').val());
                $.post(url,
                    {
                        getSubCate: $('#category').val(),
                        dataType:"json"
                    },
                    function(data){
                        $('#loadingsearch').hide();
                        //alert(data);return false;
                        var opt = '';
                        $.each($.parseJSON(data), function(idx, obj) {
                            opt += '<option value="'+idx+'">'+obj+'</option>';
                        });
                        //alert(opt);
                        $('#subcategory')
                            .find('option')
                            .remove()
                            .end()
                            .append(opt)
                        ;
                    }
                );
            //});
        }
    },
    changeSubCategory : function(url){
        //$('#subcategory').change( function(event) {
            $('#loadingsearch').show();
            $.post(url,
                {
                    getSub2Cate: $('#subcategory').val(),
                    dataType:"json"
                },
                function(data,status){
                    $('#loadingsearch').hide();
                    var opt = '';
                    $.each($.parseJSON(data), function(idx, obj) {
                        opt += '<option value="'+idx+'">'+obj+'</option>';
                    });

                    $('#sub2category')
                        .find('option')
                        .remove()
                        .end()
                        .append(opt)
                    ;
                }
            );
        //});
    },
    update : function(url){
        //alert('change status');
        $.post(url, '', function(data) { alert('Đã cập nhật thành công');});
    },

}
