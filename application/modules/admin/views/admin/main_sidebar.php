<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="/dist/img/halong.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?=$this->session->userdata("userName")?></p>
        <!-- Status -->
        <a href="<?=base_url('admin')?>/logout"><i class="fa fa-circle text-success"></i> Logout</a>
      </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Main control functions</li>
      <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
      </li>
      <!-- Optionally, you can add icons to the links -->
      <li class="treeview active">
        <a href="listUser"><i class="fa fa-users"></i> <span>Quản lý user</span><i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url('admin')?>/users/list_user">User hệ thống</a></li>
          <li><a href="<?=base_url('admin')?>/listMember">User đăng ký </a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-tasks"></i> <span>Quản lý modules</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url('admin')?>/list_module">Quản lý module</a></li>
          <li><a href="<?=base_url('admin')?>/list_submodule">Quản lý module con</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#"><i class="fa fa-desktop"></i> <span>Quản lý giao diện</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="<?=base_url('admin')?>/list_layout">Quản lý layout</a></li>
          <li><a href="<?=base_url('admin')?>/list_layoutcom">Quản lý component layout</a></li>
          <li><a href="<?=base_url('admin')?>/list_layoutsubcom">Quản lýc sub component layout</a></li>
        </ul>
      </li>
      <?php
        $leftMenu = leftNaviba();
        foreach($leftMenu as $module):
          $arrSubModule = getFiledSubTable('mod_id',$module->id,'submodules_model','id,name,module_ctr,module_act');
          $tmpCount = count($arrSubModule);
        echo '<li class="treeview">';
          echo ($tmpCount > 0) ? '<a href="'.base_url($module->module_ctr).'/'.$module->module_act.'"><i class="fa fa-connectdevelop"></i> <span>'.$module->name.'</span><i class="fa fa-angle-left pull-right"></i></a>' : '<a href="'.base_url($module->module_ctr).'/'.$module->module_act.'"><i class="fa fa-link"></i> <span>'.$module->name.'</span></a>';
      
          if( $tmpCount > 0):
      
            echo '<ul class="treeview-menu">';
            foreach($arrSubModule as $subModule):
      ?>
              <li><a href="<?=base_url($module->module_ctr)?>/<?=$subModule->module_act?>"><?=$subModule->name?></a></li>
      <?php
            endforeach;
              echo '</ul>';
          endif;
      ?>
        </li>
      <?php    
        endforeach;
      ?>
        <!--li>
          <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li-->
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>