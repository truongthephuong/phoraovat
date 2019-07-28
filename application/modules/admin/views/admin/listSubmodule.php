
<script type='text/javascript' src="<?php echo base_url(); ?>js/user.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?php echo base_url(); ?>bootstrap/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/user.css" />

<link href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/datatables/fixedHeader.bootstrap.min.css" />
<script type='text/javascript' src="<?php echo base_url(); ?>js/datatables/jquery.dataTables.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>js/datatables/dataTables.fixedHeader.min.js"></script>


<script type="text/javascript" charset="utf8" src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<script>
    var SITE_URL = "<?php echo site_url()?>";
    var BASE_URL = "<?php echo base_url(); ?>";
    //loading image for thickbox

    $(document).ready(function(){
        $('#lstData').DataTable({
            "columnDefs": [
                {
                    'bSortable' : true,
                    'aTargets' : [ 1,3 ],
                    'targets' : [ 7,6 ],"orderable": false
                }
            ]
        });

    });

</script>

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
                                    <div class="table-header-text">SubModules Management</div>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary addnew" data-toggle="modal" data-target="#add_user"><span class=" glyphicon  glyphicon glyphicon-plus" aria-hidden="true"></span> Add New</button>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped" id="lstData">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Module</th>
                                            <th>Name</th>
                                            
                                            <th>Controller</th>
                                            <th>Module Act</th>
                                            <th>Folder Name</th>
                                            <th>Icon</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($lstSubModule as $submodule):?>
                                        <tr>
                                            <td><?php echo $submodule->id?></td>
                                            <td><?php echo $submodule->subname?></td>
                                            <td><?php echo $submodule->name?></td>
                                            
                                            <td><?php echo $submodule->module_ctr?></td>
                                            <td><?php echo $submodule->module_act?></td>
                                            <td><?php echo $submodule->folder_url?></td>
                                            <td><?php echo $submodule->icon?></td>
                                            <td>
                                            <a href="#" onClick ="javascript:userObj.changeStatus('<?php echo base_url()?>admin/changeStatus/<?php echo $submodule->id?>/<?php echo $submodule->status?>/id/cms_submodules');">
                                                <input type="checkbox" <?php echo $submodule->status == '1' ? 'checked' : '' ?> data-toggle="toggle" data-on="ENABLED" data-off="DISABLED" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="120px">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="editSubModule/<?php echo $submodule->id?>"> 
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
                    




