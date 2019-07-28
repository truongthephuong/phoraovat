<script type='text/javascript' src="<?php echo base_url(); ?>js/user.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?php echo base_url(); ?>bootstrap/js/bootstrap-toggle.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>bootstrap/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/user.css" />

<script type="text/javascript">
    
    $("button[id='closeModal']").click(function(){
        $("#editModal").modal('hide');
        location.reload(true);
    });
    
</script>
<!--Modal for Edit permission-->
<div >
    <div class="modal-dialog">
    <form method="post" action="groupEdit" class="form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeModal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Group Edit</h4>
            </div>
            <div class="edit-body">
                <?php
                    foreach($lstGroup as $grp):
                ?>
                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="name">Group Name :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="name" value="<?php echo ($grp->name) ? $grp->name : '' ?>" placeholder="Group Name">
                            </div>
                        </div>
                        
                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="rank">Rank :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="rank" value="<?php echo ($grp->rank) ? $grp->rank : '' ?>" placeholder="Group Rank">
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="status">Status :</label>
                            <div class="col-sm-6">
                                <input type="checkbox" name="status" <?php echo $grp->status == '1' ? 'checked' : '' ?> data-toggle="toggle" data-on="ENABLED" data-off="DISABLED" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="120px">
                            </div>
                        </div>
                <?php
                    endforeach;
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </form>
    </div>
</div>