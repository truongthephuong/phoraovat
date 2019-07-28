<?php
	//var_dump($lstUser);
?>
<script type='text/javascript' src="<?php echo base_url();?>js/user.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?php echo base_url(); ?>bootstrap/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/user.css" />
<div class="container-fluid contentbox">
        <!--<div class="current-page">Settings </div>-->

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
                                    <div class="table-header-text">Cms Config Management</div>
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
                                        	<th>ID.</th>
                                            <th>Title Web</th>
                                            <th>Address Web</th>
                                            <th>Email Administrator</th>
                                            <th>Email Contact</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($lstConfig as $cmsCfg):?>
                                        <tr>
                                            <td><?php echo $cmsCfg->id?></td>
                                            <td><?php echo $cmsCfg->title_web?></td>
                                            <td><?php echo $cmsCfg->address_web?></td>
                                            <td><?php echo $cmsCfg->email_admin?></td>
                                            <td><?php echo $cmsCfg->email_contact?></td>
                                            <td> 
                                            	<i class="edit-icon fa fa-pencil-square-o"></i>
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
                    




