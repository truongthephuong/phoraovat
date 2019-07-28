<?php
	$act = $this->router->fetch_method();
	$actUser = '';
	$actModule = '';
	$actSubmodule = '';
	$actConfig = '';
	$actGroup = '';
	$actLayout = '';
	$actLayoutCom = '';
	$actPosition = '';

	switch ($act) {
		case 'list_module' :
			$actModule = 'class="active"';
			break;
		case 'editModule' :
			$actModule = 'class="active"';
			break;
		case 'list_submodule' :
			$actSubmodule = 'class="active"';
			break;
		case 'cms_config' :
			$actConfig = 'class="active"';
			break;
		case 'list_group' :
			$actGroup = 'class="active"';
			break;
		case 'list_component' :
			$actLayoutCom = 'class="active"';
			break;
		case 'list_position' :
			$actPosition = 'class="active"';
			break;
		case 'index' :
			$actUser = 'class="active"';
			break;
		default:
			$actUser = 'class="active"';
			break;
	}
?>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" <?php echo $actUser?>><a href="<?php echo base_url('admin')?>/users/list_user" aria-controls="users" role="tab" >Users</a></li>
    <li role="presentation" <?php echo $actGroup?>><a href="<?php echo base_url('admin')?>/list_group" aria-controls="parameters" role="tab" >Groups</a></li>
    <li role="presentation" <?php echo $actModule?>><a href="<?php echo base_url('admin')?>/list_module" aria-controls="allocation_tabs" role="tab" >Modules</a></li>
    <li role="presentation" <?php echo $actSubmodule?>><a href="<?php echo base_url('admin')?>/list_submodule" aria-controls="email_templates" role="tab" >Submodules</a></li>
<!--     <li role="presentation" <?php echo $actLayoutCom?>><a href="<?php echo base_url('admin')?>/list_component" aria-controls="email_templates" role="tab" >Thành phần layout</a></li>
    <li role="presentation" <?php echo $actPosition?>><a href="<?php echo base_url('admin')?>/list_position" aria-controls="email_templates" role="tab" >Quản lý position</a></li>
 -->    <li role="presentation" <?php echo $actConfig?>><a href="<?php echo base_url('admin')?>/cms_config" aria-controls="email_templates" role="tab" >Config</a></li>      
</ul>