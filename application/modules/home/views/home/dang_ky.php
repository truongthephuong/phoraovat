<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22-Apr-17
 * Time: 2:35 PM
 */
?>
<style type="text/css">

	#signup {
	    padding: 5px 25px 25px;
	    background: #fff;
	    box-shadow: 
	        0px 0px 0px 5px rgba( 255,255,255,0.4 ), 
	        0px 4px 20px rgba( 0,0,0,0.33 );
	    -moz-border-radius: 5px;
	    -webkit-border-radius: 5px;
	    border-radius: 5px;
	    display: table;
	    position: static;
	}

	#signup .header h3 {
	    color: #333333;
	    font-size: 24px;
	    font-weight: bold;
	    margin-bottom: 5px;
	}

	#signup .header p {
	    color: #8f8f8f;
	    font-size: 14px;
	    font-weight: 300;
	}

	#signup .sep {
	    height: 1px;
	    background: #e8e8e8;
	    width: 406px;
	    margin: 0px -25px;
	}

	#signup .inputs {
	    margin-top: 25px;
	}

	#signup .inputs label {
	    color: #8f8f8f;
	    font-size: 12px;
	    font-weight: 300;
	    letter-spacing: 1px;
	    margin-bottom: 7px;
	    display: block;
	}

	input::-webkit-input-placeholder {
	    color:    #b5b5b5;
	}

	input:-moz-placeholder {
	    color:    #b5b5b5;
	}

	#signup .inputs input[id=email], input[id=password], input[id=username], input[id=captcha] {
	    background: #f5f5f5;
	    font-size: 0.8rem;
	    -moz-border-radius: 3px;
	    -webkit-border-radius: 3px;
	    border-radius: 3px;
	    border: none;
	    padding: 13px 10px;
	    width: 330px;
	    margin-bottom: 20px;
	    box-shadow: inset 0px 2px 3px rgba( 0,0,0,0.1 );
	    clear: both;
	}

	#signup .inputs input[id=email]:focus, input[id=password]:focus, input[id=username]:focus, input[id=captcha]:focus {
	    background: #fff;
	    box-shadow: 0px 0px 0px 3px #fff38e, inset 0px 2px 3px rgba( 0,0,0,0.2 ), 0px 5px 5px rgba( 0,0,0,0.15 );
	    outline: none;   
	}

	#signup .inputs .checkboxy {
	    display: block;
	    position: static;
	    height: 25px;
	    margin-top: 10px;
	    clear: both;
	}

	#signup .inputs input[type=checkbox] {
	    float: left;
	    margin-right: 10px;
	    margin-top: 3px;
	}

	a.rule  {
		color: #b81509;
	}

	#signup .inputs label.terms {
	    float: left;
	    font-size: 14px;
	    font-style: italic;
	}

	#signup .inputs #submit {
	    width: 100%;
	    margin-top: 20px;
	    padding: 15px 0;
	    color: #fff;
	    font-size: 14px;
	    font-weight: 500;
	    letter-spacing: 1px;
	    text-align: center;
	    text-decoration: none;
	        background: -moz-linear-gradient(
	        top,
	        #b9c5dd 0%,
	        #a4b0cb);
	    background: -webkit-gradient(
	        linear, left top, left bottom, 
	        from(#b9c5dd),
	        to(#a4b0cb));
	    -moz-border-radius: 5px;
	    -webkit-border-radius: 5px;
	    border-radius: 5px;
	    border: 1px solid #737b8d;
	    -moz-box-shadow:
	        0px 5px 5px rgba(000,000,000,0.1),
	        inset 0px 1px 0px rgba(255,255,255,0.5);
	    -webkit-box-shadow:
	        0px 5px 5px rgba(000,000,000,0.1),
	        inset 0px 1px 0px rgba(255,255,255,0.5);
	    box-shadow:
	        0px 5px 5px rgba(000,000,000,0.1),
	        inset 0px 1px 0px rgba(255,255,255,0.5);
	    text-shadow:
	        0px 1px 3px rgba(000,000,000,0.3),
	        0px 0px 0px rgba(255,255,255,0);
	    display: table;
	    position: static;
	    clear: both;
	}

	#signup .inputs #submit:hover {
	    background: -moz-linear-gradient(
	        top,
	        #a4b0cb 0%,
	        #b9c5dd);
	    background: -webkit-gradient(
	        linear, left top, left bottom, 
	        from(#a4b0cb),
	        to(#b9c5dd));
	}
</style>
<script src="<?php echo base_url() ?>js/jquery.validate.js"></script>

<script>
	$().ready(function(){
		//Get refresh captcha code
		$('.refreshCaptcha').on('click', function(){
			$.get('<?php echo base_url().'home/refresh'; ?>', function(data){
				$('#captImg').html(data);
			});
		});

		$('#username').focus();
		$("#signup").validate({
			rules: {
				email: {
					required: true,
					email: true,
					remote: {
						url: "<?php echo base_url('home')?>/emailExist",
						type: "post"
					},
					maxlength: 128
				},
				username: {
					required: true,
					remote: {
						url: "<?php echo base_url('home')?>/userExist",
						type: "post"
					},
					minlength: 6,
					maxlength: 32
				},
				password: {
					required: true,
					minlength: 8,
					maxlength: 50
				},
				checky:{
					required: true
				},
			},
			messages: {
				username: {
					required: "Nhập tên đăng nhập/số điện thoại",
					remote: "Tên đăng nhập đã có trên hệ thống",
				},

				email: {
					required: "Nhập địa chỉ email",
					email: "Email không đúng định dạng",
					remote: "Địa chỉ email đã có trên hệ thống",
				},
				password: "Nhập mật khẩu",
				checky: "Bạn chưa chấp nhân quy định"
			},
		});
	});
</script>
<div class="main-block" style="height: 76vh !important">
	<div class="bg-black">
		<div class="inner main-cont">
			<div class="detail">
			    <form id="signup" method="post" action="<?php echo base_url('home')?>/dang_ky">
			        <h3>Đăng Ký Thành Viên</h3>
			        <div class="sep"></div>
			        <div class="inputs">
				        <label></label>
				        <input type="text" id="username" name="username" placeholder="Tên đăng nhập/Số điện thoại" autofocus />
			            <label></label>
				        <input type="text" id="email" name="email" placeholder="e-mail"  />
			            <label></label>
				        <input type="password" id="password" name="password" placeholder="Mật khẩu" />
			            <div class="checkboxy">
			                <input name="checky" id="checky" value="1" type="checkbox" />
				            <label class="terms">Tôi đồng ý với <a href="<?php echo base_url('home/userRule');?>" class="rule">điều khoản sử dụng</a>
				            </label>
			            </div><br />
				        <input type="text" id="captcha" name="captcha" placeholder="Nhập mã bảo vệ bên dưới"  />
				        <p id="captImg">
					            <?php echo $captchaImg; ?>
				        </p>
				        <a href="javascript:void(0);" class="refreshCaptcha" >
					        <img src="<?php echo base_url().'images/refresh.png'; ?>" style="width: 60px;"/>
				        </a>
			            <button type="submit" id="submit" name="dangky" value="dangky">ĐĂNG KÝ</button>
			        </div>
			    </form>
				<div>
					<?php  echo ($this->session->flashdata("memMsg")) ? $this->session->flashdata("bidMsg") : '' ;?>
				</div>
			</div>
		</div>
	</div>
</div>
