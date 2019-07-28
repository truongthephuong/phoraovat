<!-- add javascripts -->
<?php
	//echo base_url();
//echo $this->Html->script('jquery.validate');
?>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?=base_url()?>bootstrap/js/bootstrap-toggle.min.js"></script>
<script type='text/javascript' src="<?=base_url()?>bootstrap/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/user.css" />
<?php
	//echo 'last page is '.$this->session->userdata("last_page");
	echo ($this->session->flashdata('login_fail')) ? $this->session->flashdata('login_fail') : '';
?>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Log in</div>
            <div class="panel-body">
                <form role="form" id="login" action="<?=base_url()?>admin/login" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="Username" id="login" name="username" class="form-control" autofocus="">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">Remember Me
                            </label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="adminLogin">Sign in</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->

<div><?php echo ($this->session->flashdata("login_success")) ? $this->session->flashdata("login_success") : '' ;?></div>
