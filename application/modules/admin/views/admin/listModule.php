<?php
	//var_dump($lstUser);
?>
<script type='text/javascript' src="<?php echo base_url()?>js/user.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?php echo base_url()?>bootstrap/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/user.css" />
<div class="container-fluid contentbox">

        <!--Load menu tab-->
        <?php $this->load->view('/admin/menu_tab')?>

        <div class="panel panel-default">
            <div class="panel-body">

                <!-- Tabs -->

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="users">

                        <div class="row">
                            <div class="col-sm-11 pd-right">

                                <div class="table-header">
                                    <div class="table-header-text">Modules Management</div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary addnew" data-toggle="modal" data-target="#add_user"><span class=" glyphicon  glyphicon glyphicon-plus" aria-hidden="true"></span> Add New</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        	<th>ID</th>
                                            <th>Name</th>
                                            <th>Per ID</th>
                                            <th>Controller</th>
                                            <th>Module Act</th>
                                            <th>Folder Name</th>
                                            <th>Icon</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($lstModule as $module):?>
                                        <tr>
                                            <td><?php echo $module->id?></td>
                                            <td><?php echo $module->name?></td>
                                            <td><?php echo $module->per_id?></td>
                                            
                                            <td><?php echo $module->module_ctr?></td>
                                            <td><?php echo $module->module_act?></td>
                                            <td><?php echo $module->folder_url?></td>
                                            <td><?php echo $module->icon?></td>
                                            <td>
                                                <a href="#" onClick ="javascript:userObj.changeStatus('<?php echo base_url()?>admin/changeStatus/<?php echo $module->id?>/<?php echo $module->status?>/id/cms_modules');">
                                            	   <input type="checkbox" <?php echo $module->status == '1' ? 'checked' : '' ?> data-toggle="toggle" data-on="ENABLED" data-off="DISABLED" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="120px">
                                            	</a>
                                            </td>
                                            <td>
                                                <a href="editModule/<?php echo $module->id?>"> 
                                            	   <i class="edit-icon fa fa-pencil-square-o"></i>
                                                </a>
                                                <i class="trash-icon fa fa-trash" data-toggle="modal" data-target="#delete"></i>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
                    




