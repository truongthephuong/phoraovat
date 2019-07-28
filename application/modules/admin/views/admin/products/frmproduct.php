<script>
    //var SITE_URL = "<?=site_url()?>";
    //var BASE_URL = "<?=base_url()?>";
</script>
<!--script type='text/javascript' src="<?=base_url()?>js/assets/common.js"></script-->
<script type='text/javascript' src="<?=base_url()?>js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>bootstrap/css/bootstrap-toggle.min.css" />
<!--script type='text/javascript' src="<?=base_url()?>bootstrap/js/bootstrap-toggle.min.js"></script-->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/user.css" />
<script type='text/javascript' src="<?=base_url()?>js/simpleCalendar.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/simpleCalendar.css" />
<script type='text/javascript' src="<?=base_url()?>js/ckeditor/ckeditor.js"></script>

<script>
    //var ck_newsContent = CKEDITOR.replace( 'content' );
    //ck_newsContent.setData( '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' );

    $().ready(function() {
        var curImg = '<?php echo (isset($image)) ? $image : ""?>';
        $('#i_file').change( function(event) {
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $("#tmpImg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
        });
        //alert(curImg);
        if(curImg != ""){
            $("#tmpImg").fadeIn("fast").attr('src','/upload/products/'+curImg);
        }
        calendar.set("created");
        //calendar.set("endDate");
    });

    $(document).on('change', '#category', function(event) {
        event.preventDefault();
        $('#loadingsearch').show();
        var url = '/admin/ajaxcall/getSubCateList/';
            //alert(url);return false;
        $.post(url,
            {
                getSubCate: $('#category').val(),
                dataType:"json"
            },
            function(data,status){
                $('#loadingsearch').hide();
                    //alert(data);return false;
                var opt = '';
                $.each($.parseJSON(data), function(idx, obj) {
                    opt += '<option value="' + idx + '">' + obj + '</option>';
                });
                    //alert(opt);return false;
                    $('#subcategory').find('option').remove().end().append(opt);
            }
        );
    });

    $(document).on('change', '#subcategory', function(event) {
        $('#loadingsearch').show();
        var url = '/admin/ajaxcall/getSubCateOpt2/';
        $.post(url,
            {
                //category: $('#category').val(),
                subCategory: $('#subcategory').val(),
                dataType:"json"
            },
            function(data,status){
                console.log(data);
                $('#loadingsearch').hide();
                var opt = '';
                $.each($.parseJSON(data), function(idx, obj) {
                    opt += '<option value="' + idx + '">' + obj + '</option>';
                });

                //$('#listServices').css('display', "block");
                $('#service').find('option').remove().end().append(opt);
            }
        );
    });

    $(document).on('keyup', '#myInputPrice', function(event){
        var priceInput = formatNumber($('#myInputPrice').val(), );
        $('#myLabelPrice').html('<b>' + priceInput + ' vnđ</b>').change();
    });
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script>
<?php $chkProdStyle = (intval($prodStyle) == 1) ? 'checked' : ''; ?>
<div class="container-fluid contentbox">
    <!--Load menu tab-->
    <?php $this->load->view('/admin/product_tab')?>
    <div class="panel panel-default">
        <div class="panel-body">
            <!-- Tabs -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="modules">
                    <div class="row">
                        <div class="col-sm-12 pd-right">
                            <div class="table-header">
                                <div class="table-header-text">Chỉnh sửa sản phẩm - dịch vụ</div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div id='loadingsearch' class="tcenter" style='display:none'>
                        <img style="width:auto; display:inline-block;" src='/images/loading2.gif'/>
                    </div>
                    <?php
                    if($errors != ""){
                        echo $errors;
                    }
                    $baseUrl = '';
                    if(isset($addNew)){
                        $baseUrl =  base_url('admin/products').'/addNew';
                    }else{
                        $baseUrl = base_url('admin/products').'/productEdit/'.$uID;
                    }
                    ?>
                    <div class="row">

                        <form method="post" action="<?php echo $baseUrl?>" class="form-horizontal" enctype="multipart/form-data">
                            <?php
                            //foreach($lstNews as $news):
                                ?>
                                <div class="form-group form-group-sm">
                                    <label class="col-sm-1 control-label" for="name">Danh mục:</label>
                                    <div class="col-sm-2">
                                        <?php 
                                            $js = array(
                                                'id'       => 'category',
                                                'class'    => 'form-control'
                                            );
                                            echo form_dropdown('cate_id', $arrOpt,(isset($cate_id)) ? $cate_id : 0 , $js);
                                        ?>
                                    </div>
                                    <label class="col-sm-2 control-label" for="name">Danh mục con :</label>
                                    <div class="col-sm-2">
                                        <?php
                                        $js = array(
                                            'id'       => 'subcategory',
                                            'class'    => 'form-control'
                                        );
                                        echo form_dropdown( 'subcate_id' , $arrSubOpt , (isset($subcate_id)) ? $subcate_id : 0 , $js);
                                        ?>
                                    </div>
                                    <label class="col-sm-2 control-label" for="name">Danh mục con cấp 1:</label>
                                    <div class="col-sm-2">
                                        <?php
                                            $js = array(
                                                'id'       => 'subcategory1',
                                                'class'    => 'form-control'
                                            );
                                            echo form_dropdown( 'subcate1_id' , $arrSubOpt1 , (isset($subcate1_id)) ? $subcate1_id : '' , $js);
                                            $prodStyle = 1;
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group form-group-sm">
                                    <label class="col-sm-1 control-label" for="prodStyle">Loại SP :</label>
                                    <div class="col-sm-3">
                                        <input type="checkbox" <?php echo $chkProdStyle ?> data-toggle="toggle" data-on="Sản phẩm" data-off="Dịch vụ" data-onstyle="success" data-offstyle="info" data-size="mini" data-width="120px" class="form-control">
                                    </div>

                                </div>

                                <div class="form-group form-group-sm">
                                    <label class="col-sm-1 control-label" for="name">Tên SP :</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="name" value="<?php echo (isset($name)) ? $name : '' ?>" placeholder="News Title">
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label class="col-sm-1 control-label" for="phpFile">Mô tả :</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="description" value="<?php echo (isset($description)) ? $description : '' ?>" placeholder="Description">
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label class="col-sm-1 control-label" for="phpFile">Chi tiết :</label>
                                    <div class="col-sm-10">
                                        <?php echo form_textarea('content', (isset($detail)) ? $detail : '', "class = 'ckeditor'")
                                        //echo $this->ckeditor->editor('content',($news->content) ? $news->content : '');
                                        ?>

                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label class="col-sm-1 control-label" for="name">Giá :</label>
                                    <div class="col-sm-3">
                                        <input id="myInputPrice" type="number" class="form-control" name="price" value="<?php echo (isset($price)) ? $price : '' ?>" placeholder="Product Prices">
                                    </div>
                                    <div class="col-sm-2"><span id="myLabelPrice"></span></div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label class="col-sm-1 control-label" for="name">Giá KM:</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" name="promo" value="<?php echo (isset($promo)) ? $promo : '' ?>" placeholder="Product Prices Promotion">
                                    </div>
                                </div>
                                    <div class="form-group form-group-sm">
                                    <label class="col-sm-1 control-label" for="rank">Thứ tự :</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" name="rank" value="<?php echo (isset($rank)) ? $rank : '' ?>" placeholder="Rank">
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label class="col-sm-1 control-label" for="name">Ngày đăng :</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="created" id="created" value="<?php echo (isset($created)) ? $created : '' ?>" placeholder="Created date">
                                    </div>
                                </div>

                                <div class="form-group form-group-sm">
                                    <label class="col-sm-1 control-label" for="status">Trạng thái :</label>
                                    <div class="col-sm-3">
                                        <input type="checkbox" name="status" <?php echo (isset($status) && $status == '1') ? 'checked' : '' ?> data-toggle="toggle" data-on="ENABLED" data-off="DISABLED" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="120px">
                                    </div>
                                </div>
                                <div class="form-group form-group-sm">
                                    <label class="col-sm-1 control-label" for="folderUrl">Hình ảnh :</label>
                                    <div class="col-sm-6">
                                        <input type="file" id="i_file" value="" name="img"><br />
                                        <img id="tmpImg" src="" style="display:none;width:200px" />
                                    </div>
                                </div>
                                <?php
                            //endforeach;
                            ?>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="bntBack">Cancel</button>
                                <button type="submit" class="btn btn-primary" value="saveEdit" name="saveEdit">Save changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>