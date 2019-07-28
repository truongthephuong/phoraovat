<?php
	//var_dump($lstUser);
?>
<script type='text/javascript' src="<?php echo base_url(); ?>js/user.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?php echo base_url(); ?>bootstrap/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/user.css" />
<div class="container-fluid contentbox">
        <!--<div class="current-page">Settings </div>-->

        <!--Load menu tab-->
        <?php $this->load->view('/admin/layout_tab')?>

        <div class="panel panel-default">
            <div class="panel-body">

                <!-- Tabs -->

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="users">

                        <div class="row">
                            <div class="col-sm-11 pd-right">

                                <div class="table-header">
                                    <div class="table-header-text">Layout Style Management</div>
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
                                            <th>Theme</th>
                                            <th>Width</th>
                                            <th>Height</th>
                                            <th>Back Ground</th>
                                            <th>Title</th>
                                            <th>Meta Tag</th>
                                            <th>Des Tag</th>
                                            <th>Enable</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($lstLayout as $layout):?>
                                        <tr>
                                            <td><?php echo $layout->id?></td>
                                            <td><?php echo $layout->theme?></td>
                                            <td><?php echo $layout->width?></td>
                                            <td><?php echo $layout->height?></td>
                                            <td><?php echo $layout->style_bg?></td>
                                            <td><?php echo $layout->title?></td>
                                            <td><?php echo $layout->meta?></td>
                                            <td><?php echo $layout->meta_des?></td>
                                            <td>
                                            <a href="#" onClick ="javascript:userObj.changeStatus('admin/changeStatus/<?php echo $layout->id?>/<?php echo $layout->status?>');">
                                                <input type="checkbox" <?php echo $layout->status == '1' ? 'checked' : '' ?> data-toggle="toggle" data-on="ENABLED" data-off="DISABLED" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="120px">
                                                </a>
                                            </td>
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
                    




