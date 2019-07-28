<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url() ?>bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/skins/_all-skins.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style type="text/css">
        /*Css for paging*/
        #pagination{
            margin: 40 40 0;
        }
        ul.tsc_pagination li a{
            border:solid 1px;
            border-radius:3px;
            -moz-border-radius:3px;
            -webkit-border-radius:3px;
            padding:6px 9px 6px 9px;
        }
        ul.tsc_pagination li{
            padding-bottom:1px;
        }
        ul.tsc_pagination li a:hover,
        ul.tsc_pagination li a.current{
            color:#FFFFFF;
            box-shadow:0px 1px #EDEDED;
            -moz-box-shadow:0px 1px #EDEDED;
            -webkit-box-shadow:0px 1px #EDEDED;
        }
        ul.tsc_pagination{
            margin:4px 0;
            padding:0px;
            height:100%;
            overflow:hidden;
            font:12px 'Tahoma';
            list-style-type:none;
        }
        ul.tsc_pagination li{
        float:left;
        margin:0px;
        padding:0px;
        margin-left:5px;
        }
        ul.tsc_pagination li a
        {
        color:black;
        display:block;
        text-decoration:none;
        padding:7px 10px 7px 10px;
        }
        ul.tsc_pagination li a img
        {
        border:none;
        }
        ul.tsc_pagination li a
        {
        color:#0A7EC5;
        border-color:#8DC5E6;
        background:#F8FCFF;
        }
        ul.tsc_pagination li a:hover,
        ul.tsc_pagination li a.current
        {
        text-shadow:0px 1px #388DBE;
        border-color:#3390CA;
        background:#58B0E7;
        background:-moz-linear-gradient(top, #B4F6FF 1px, #63D0FE 1px, #58B0E7);
        background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #B4F6FF), color-stop(0.02, #63D0FE), color-stop(1, #58B0E7));
        }
    </style>

</head>
<body class="hold-transition sidebar-mini skin-black-light">
<div class="wrapper">

    <!-- Main Header -->
    <?php echo $this->load->view('/admin/main_header','',TRUE)?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php
    if($this->session->userdata("userName")){
        $this->load->view('/admin/main_sidebar');
    } 
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php 
      if(!empty($subview)):
        $this->load->view($subview);
      else:   
        $this->load->view('/admin/dashboard','',TRUE);
      endif;
    ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <?php echo $this->load->view('/admin/main_footer','',TRUE);?>
  <!-- Control Sidebar -->
  <?php echo $this->load->view('/admin/main_control_sidebar','',TRUE)?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>bower_components/jquery/dist/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<!--script src="<?php echo base_url() ?>bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>bower_components/morris.js/morris.min.js"></script-->
<!-- Sparkline -->
<script src="<?php echo base_url() ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url() ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url() ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url() ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url() ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url() ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<!--script src="<?php //echo base_url() ?>bower_components/fastclick/lib/fastclick.js"></script-->
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--script src="<?php echo base_url() ?>dist/js/pages/dashboard.js"></script-->
<!-- AdminLTE for demo purposes -->
<!--script src="<?php //echo base_url() ?>dist/js/demo.js"></script-->

<script type='text/javascript' src="<?=base_url()?>bootstrap/js/bootstrap-toggle.min.js"></script>

</body>
</html>
