<?php
	//var_dump($lstUser);
?>
<script type='text/javascript' src="<?php echo base_url()?>js/user.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?php echo base_url()?>bootstrap/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/user.css" />

<script>
    $(function() {
        $("a[data-target=#myModal]").click(function (ev) {
            
            ev.preventDefault();
            var $this = $(this);
            var target = $this.data('remote');
            
            // load the url and show modal on success
            $("#myModal .modal-body").load(target, function() {
                $(this).find('.modal-body').css({
                    width:'900px', //probably not needed
                    height:'auto', //probably not needed 
                    //'max-height':'100%'
                });
                $("#myModal").modal("show");
                $('#myModal').modal('handleUpdate');
            });
        });

        $("a[data-target=#editModal]").click(function (ev) {
            
            ev.preventDefault();
            var $this = $(this);
            var target = $this.data('remote');
            
            // load the url and show modal on success
            $("#editModal .edit-body").load(target, function() {
                $(this).find('.edit-body').css({
                    //width:'600px', //probably not needed
                    height:'auto', //probably not needed 
                    //'max-height':'100%'
                });
                $("#editModal").modal("show");
                $('#editModal').modal('handleUpdate');
            });
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
                                    <div class="table-header-text">Groups Management</div>
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
                                            <th>Rank</th>
                                            <th>Enable</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($lstGroup as $group):?>
                                        <tr>
                                            <td><?php echo $group->id?></td>
                                            <td><?php echo $group->name?></td>
                                            <td><?php echo $group->rank?></td>
                                            
                                            <td>
                                            <a href="#" onClick ="javascript:userObj.changeStatus('<?php echo base_url()?>admin/changeStatus/<?php echo $group->id?>/<?php echo $group->status?>/id/user_types');">
                                                <input type="checkbox" <?php echo $group->status == '1' ? 'checked' : '' ?> data-toggle="toggle" data-on="ENABLED" data-off="DISABLED" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="120px">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#myModal" role="button" class="btn" data-toggle="modal" data-remote="perEdit/<?php echo $group->id?>" data-remote-target="#myModal .modal-body">
                                                <i class="glyphicon glyphicon-user"></i>
                                                </a>
                                                <a href="#editModal" role="button" class="btn" data-toggle="modal" data-remote="groupEdit/<?php echo $group->id?>" data-remote-target="#editModal .edit-body">  
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
                    
<!--Modal for Edit permission-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Permission Edit</h4>
            </div>
            <div class="modal-body">
                <i class='fa fa-refresh fa-spin fa-5x'></i>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    
    </div>
</div>

<!--Modal for Edit Group-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="edit-body">
                <i class='fa fa-refresh fa-spin fa-5x'></i>
            </div>
        </div>
    </div>
</div>