<script type='text/javascript' src="<?php echo base_url()?>js/user.js"></script>
<script type='text/javascript' src="<?php echo base_url()?>js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?php echo base_url()?>bootstrap/js/bootstrap-toggle.min.js"></script>
<script type='text/javascript' src="<?php echo base_url()?>bootstrap/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/user.css" />

<script>
    $().ready(function() {

    	$('#i_file').change( function(event) {
               var tmppath = URL.createObjectURL(event.target.files[0]);
               $("#tmpImg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
        });



    });
</script>

<div class="container-fluid contentbox">
    <!--Load menu tab-->
    <?php $this->load->view('/admin/menu_tab')?>
    <div class="panel panel-default">
    	<div class="panel-body">
            <!-- Tabs -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="modules">
                    <div class="row">
                        <div class="col-sm-12 pd-right">
                            <div class="table-header">
                                <div class="table-header-text">Sub Modules Edit</div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <?php
                    	if($errors != ""){
				            echo $errors;
				        }
                    ?>
                    <div class="row">
                    	
                    	<form method="post" action="<?php echo base_url('admin')?>/editSubModule/<?php echo $uID?>" class="form-horizontal" enctype="multipart/form-data">
	                <?php
	                    foreach($lstSubModule as $module):
	                ?>
	                        <div class="form-group form-group-sm">
	                            <label class="col-sm-2 control-label" for="name">Module Name :</label>
	                            <div class="col-sm-3">
                    <?php
                        		$arrModule = getArrOpt( 'modules_model' , 'getAllList');
                          		echo form_dropdown('mod_id', $arrModule,$module->mod_id);
                    ?>
	                            </div>
	                        </div>

	                        <div class="form-group form-group-sm">
	                            <label class="col-sm-2 control-label" for="name">Sub Module Name :</label>
	                            <div class="col-sm-3">
	                                <input type="text" class="form-control" name="name" value="<?php echo ($module->name) ? $module->name : '' ?>" placeholder="Module Name">
	                            </div>
	                        </div>
	                        <div class="form-group form-group-sm">
	                            <label class="col-sm-2 control-label" for="phpFile">Controller :</label>
	                            <div class="col-sm-3">
	                                <input type="text" class="form-control" name="module_ctr" value="<?php echo ($module->module_ctr) ? $module->module_ctr : '' ?>" placeholder="Controller name">
	                            </div>
	                        </div>
	                        <div class="form-group form-group-sm">
	                            <label class="col-sm-2 control-label" for="phpFile">Action :</label>
	                            <div class="col-sm-3">
	                                <input type="text" class="form-control" name="module_act" value="<?php echo ($module->module_act) ? $module->module_act : '' ?>" placeholder="Action name">
	                            </div>
	                        </div>
	                        <div class="form-group form-group-sm">
	                            <label class="col-sm-2 control-label" for="folderUrl">Folder Name :</label>
	                            <div class="col-sm-3">
	                                <input type="text" class="form-control" name="folder_url" value="<?php echo ($module->folder_url) ? $module->folder_url : '' ?>" placeholder="Folder name">
	                            </div>
	                        </div>
	                        
	                        <div class="form-group form-group-sm">
	                            <label class="col-sm-2 control-label" for="rank">Rank :</label>
	                            <div class="col-sm-3">
	                                <input type="text" class="form-control" name="rank" value="<?php echo ($module->rank) ? $module->rank : '' ?>" placeholder="ModuleRank">
	                            </div>
	                        </div>

	                        <div class="form-group form-group-sm">
	                            <label class="col-sm-2 control-label" for="status">Status :</label>
	                            <div class="col-sm-3">
	                                <input type="checkbox" name="status" <?php echo $module->status == '1' ? 'checked' : '' ?> data-toggle="toggle" data-on="ENABLED" data-off="DISABLED" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="120px">
	                            </div>
	                        </div>
	                        <div class="form-group form-group-sm">
	                            <label class="col-sm-2 control-label" for="folderUrl">Icon :</label>
	                            <div class="col-sm-6">
	                                <input type="file" id="i_file" value="" name="iconModule"><br /> 
                        			<img id="tmpImg" src="" style="display:none;width:200px" />
	                            </div>
	                        </div>
	                <?php
	                    endforeach;
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