<script type='text/javascript' src="/js/user.js"></script>
<script type='text/javascript' src="<?=base_url() ?>js/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?=base_url()?>bootstrap/js/bootstrap-toggle.min.js"></script>
<script type='text/javascript' src="<?=base_url()?>bootstrap/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/user.css" />

<style type="text/css">
    .permission-dialog {
      width: 1100px;
    }

    .permission-content {
      width: 1100px;
    }

</style>

<script type="text/javascript">
    var SITE_URL = "<?=site_url()?>";
    //var exOk = <?=(isset($exOk))?"'".$submit_ok."'":"''"?>;

    $("button[id='closeModal']").click(function(){    
        //alert('Close this page');
        location.reload(true);
        $("#myModal").modal('hide');
    });

    /*$(document).ready(function() {
        alert(exOK);
        if(exOk === 'true'){
            location.reload(true);
            $("#myModal").modal('hide');
        }else if(exOk === 'false'){
            alert('Can not update permission ! ');
        }
    });*/
</script>
<!--Modal for Edit permission-->
<div style="margin-left: -200px;">
    <div class="permission-dialog">
    <form method="post" action="<?=base_url('admin')?>/perEdit/<?=$uID?>">
        <div class="modal-content permission-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="closeModal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Permission Edit</h4>
            </div>
            <div class="modal-body">
                <table class="table ">
                <?php
                    $arrModId = array();
                    foreach($arrModuleId as $moduleId):
                        array_push($arrModId, $moduleId->id_mod);
                    endforeach;

                    $arrSubModId = array();
                    foreach($arrSubModuleId as $submoduleId):
                        array_push($arrSubModId, $submoduleId->id_submod);
                    endforeach;
                    //var_dump($arrModId);
                    $cnt = 0;
                    foreach($lstModule as $module):

                    if($cnt == 0){
                        echo '<tr>';
                        
                    }
                    echo '<td>';
                    $cnt++;
                ?>
                    <div class="panel-group">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="modId[]" <?php echo (in_array($module->id,$arrModId)) ? 'checked' : '' ?> value="<?=$module->id?>"><?=$module->name?></label>
                                </div>
                            </div>
                            <div class="panel-body">
                            <?php
                                $objSubModule = getFiledSubTable('mod_id',$module->id,'submodules_model','id,name,icon');
                                echo '<ul >';
                                foreach($objSubModule as $subModule):
                            ?>
                                <li><div class="checkbox"><label><input type="checkbox" name="subModId[]" <?php echo (in_array($subModule->id,$arrSubModId)) ? 'checked' : '' ?> value="<?=$subModule->id?>"><?=$subModule->name?></label></div></li>
                            <?php        
                                endforeach;
                                echo '</ul>';
                            ?>
                            </div>
                        </div>
                    </div>
                <?php
                
                    echo '</td>';
                    if($cnt % 4 == 0){
                        echo '</tr>';
                        $cnt = 0; 
                    }
                    
                    endforeach;
                ?>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="closeModal">Close</button>
                <button type="submit" class="btn btn-primary" name="saveEdit" value="saveEdit">Save changes</button>
            </div>
        </div>
    </form>
    </div>
</div>