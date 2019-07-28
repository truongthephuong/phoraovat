<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 03-May-17
 * Time: 11:36 AM
 */
?>

<div class="main-block" style="height: 76vh !important">
	<div class="bg-black">
		<div class="inner main-cont">
			<div class="detail">
				<form id="signup" method="post" action="<?php echo base_url('home')?>/dang_ky">
					<h3>Đăng Nhập</h3>
					<div class="sep"></div>
					<div class="inputs">
						<label></label>
						<input type="text" id="username" name="username" placeholder="Tên đăng nhập/Số điện thoại" autofocus />
						<label></label>
						<input type="password" id="password" name="password" placeholder="Mật khẩu" />

						<button type="submit" id="submit" name="dangnhap" value="dangnhap">ĐĂNG NHẬP</button>
					</div>
				</form>
				<div>
					<?php  echo ($this->session->flashdata("memMsg")) ? $this->session->flashdata("bidMsg") : '' ;?>
				</div>
			</div>
		</div>
	</div>
</div>
