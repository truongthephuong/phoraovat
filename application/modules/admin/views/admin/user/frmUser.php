<script type='text/javascript' src="/js/user.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?=base_url()?>bootstrap/js/bootstrap-toggle.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/user.css" />

<script type="text/javascript">

    $("button[id='closeModal']").click(function(){
        $("#editModal").modal('hide');
        //location.reload(true);
    });

</script>
<?php
    $act = ($addNew == 1 ) ? 'addNew' : 'editUser';
    $arrAuth = array(0 => '--Select user type--', 1 => 'System Admin', 2 => 'System Member');
?>
<!--Modal for Edit User-->
<div >
    <div class="modal-dialog">
        <form method="post" action="<?php echo $act?>" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeModal"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $modalTitle?></h4>
                </div><br />
                <div class="edit-body">

                    <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="name">Group Name :</label>
                            <div class="col-sm-6">
                                <?php echo form_dropdown( 'grp_id' , $arrOpt , (isset($grp_id)) ? $grp_id : '' );?>
                            </div>
                    </div>

                    <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="rank">Username :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="rank" value="<?php echo (isset($login)) ? $login : '' ?>" placeholder="Username">
                            </div>
                    </div>

                    <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="rank">Password :</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="rank" value="<?php echo (isset($password)) ? $password : '' ?>" placeholder="Password">
                            </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-sm-2 control-label" for="name">User type :</label>
                        <div class="col-sm-6">
                            <?php echo form_dropdown( 'authority' , $arrAuth , (isset($authority)) ? $authority : ''  );?>
                        </div>
                    </div>

                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="status">Status :</label>
                            <div class="col-sm-6">
                                <input type="checkbox" name="avail_flg" <?=$avail_flg == '1' ? 'checked' : '' ?> data-toggle="toggle" data-on="ENABLED" data-off="DISABLED" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="120px">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>