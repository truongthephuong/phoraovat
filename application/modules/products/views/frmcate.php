<script type='text/javascript' src="/js/user.js"></script>
<script type='text/javascript' src="<?=base_url()?>js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?=base_url()?>bootstrap/js/bootstrap-toggle.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/user.css" />
<script>

    $().ready(function() {

        var curImg = '<?php echo (isset($icon)) ? $icon : ""?>';
        $('#i_file').change( function(event) {
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $("#tmpImg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
        });
        //alert(curImg);
        if(curImg != ""){
            $("#tmpImg").fadeIn("fast").attr('src','/upload/icons/'+curImg);
        }

    });
</script>


<div class="container-fluid contentbox">
    <!--Load menu tab-->
    <?php $this->load->view('/admin/product_tab')?>
<div class="panel panel-default">
    <div class="panel-body">
        <!-- Tabs -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="cate">
                <div class="row">
                    <div class="col-sm-12 pd-right">
                        <div class="table-header">
                            <div class="table-header-text"><?php echo $caption; ?></div>
                        </div>
                    </div>
                </div>
                <br />
                <?php

                    if($errors != ""){
                        echo $errors;
                    }
                    $baseUrl = '';
                    if(isset($addNew)){
                        $baseUrl =  base_url('admin/products').'/addCate';
                    }else{
                        $baseUrl = base_url('admin/products').'/cateEdit/'.$uID;
                    }

                ?>
                <div class="row">

                    <form method="post" action="<?php echo $baseUrl?>" class="form-horizontal" enctype="multipart/form-data">

                            <div class="form-group form-group-sm">
                                <label class="col-sm-2 control-label" for="name">Name :</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="name" value="<?php echo (isset($name)) ? $name : '' ?>" placeholder="Cate Name">
                                </div>
                            </div>

                            <div class="form-group form-group-sm">
                                <label class="col-sm-2 control-label" for="rank">Rank :</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="rank" value="<?php echo (isset($rank)) ? $rank : '' ?>" placeholder="Cate Rank">
                                </div>
                            </div>

                            <div class="form-group form-group-sm">
                                <label class="col-sm-2 control-label" for="folderUrl">Icon :</label>
                                <div class="col-sm-6">
                                    <input type="file" id="i_file" value="" name="img"><br />
                                    <img id="tmpImg" src="" style="display:none;width:200px" />
                                </div>
                            </div>

                            <div class="form-group form-group-sm">
                                <label class="col-sm-2 control-label" for="status">Status :</label>
                                <div class="col-sm-3">
                                    <input type="checkbox" name="status" <?php echo (isset($status) && $status == '1') ? 'checked' : '' ?> data-toggle="toggle" data-on="ENABLED" data-off="DISABLED" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="120px">
                                </div>
                            </div>

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