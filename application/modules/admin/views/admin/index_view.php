<!-- add javascripts -->
<?php
	echo site_url();
//echo $this->Html->script('jquery.validate');
?>
<script>
	$().ready(function() {
		//Please enter the alphanumeric
		jQuery.validator.addMethod("alphanum", function(value, element) {
			return this.optional(element) || /^([a-zA-Z0-9]+)$/.test(value);
			}, "Please enter the alphanumeric"
		);
		
		// validate signup form on keyup and submit
		$("#login").validate({
			rules: {				
				login: {
					required: true,
					alphanum: true,
					minlength: 4,
					maxlength: 32,
				},
				password: {
					required: true,
					alphanum: true,
					minlength: 4,
					maxlength: 50,
				},							
			},
		});
	});
</script>
			<div class="mus-block">
                <form id="login" action="/admin/login" method="post">
                    <div class="log-frm">
                        <p>Username :</p>
                        <p><input class="log-input" type="text" value="" id="login" name="login" style="ime-mode: disabled;"></p>
						<p>（＊This field is require）</p>
                        <p>Password : </p>
                        <p><input class="log-input" type="password" value="" name="password" id="password"></p>
						<p>（＊This field is require）</p>
                        <p class="log-btn tright">
							<input type="submit" value="Login" name="submit" class="btn-1">
						</p>
                        <ul class="log-link tright">
                            <li><a href="/users/forgot_password" title="forgot">Forgot password</a></li>
                        </ul>
                    </div>
                </form>
            </div>
            <!-- InstanceEndEditable -->
        </div><!--</main>-->