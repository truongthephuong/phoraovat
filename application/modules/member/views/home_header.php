<header class="header-block" id="top">
	<div class="inner">
		<h1 class="logo"><a href="/" title="logo"><p style="color: #fff">PhoRaoVat.Net </p></a></h1>
		<div class="h-ban"><a href="#" title="banner"> <?php //echo img('img/banner-rao-vat.png'); ?> </a></div>
		<ul>
			<li> <?php echo anchor($uri = '/home/dang-ky', $title = 'Đăng ký', 'title="Đăng ký"'); ?> </li>
			<li> <?php echo anchor($uri = '/home/login', $title = 'Đăng nhập', 'title="Đăng nhập"'); ?> </li>
		</ul>
	</div> <!-- H-nav -->
	<form method="post" id="frmSearch" action="<?php //echo $this->Url->build('/pages/search');?>">
		<nav class="h-nav ">
			<ul>
				<li><a href="<?= site_url() ?>">Trang chủ</a></li>
				<li><a href="<?= site_url('/home/lienhe') ?>">Liên hệ</a></li>
				<li><a href="http://phunu24h.com">Phunu24h.com</a></li>
				<li> Khu vực: <?php $arrLocation = getArrOpt('locations_model', 'getAllLocations');
					echo form_dropdown('local_id', $arrLocation); ?> </li>
				<li> Danh mục: <?php $arrCategory = getArrOpt('categories_model', 'getAllCategories');
					echo form_dropdown('cate_id', $arrCategory); ?> </li>
				<li> Từ khóa: <input style="width:200px;" type="text"
				                     value="<?php //echo (isset($searchData['name'])) ? h($searchData['name']) : '';?>"
				                     id="name0-0" name="name" placeholder="Từ khóa tìm kiếm">
					<input class="btn-1" type="submit" value="Tìm kiếm" name="search" id="btnSearch">
				</li>
			</ul>
		</nav>
	</form>
	<!-- End H-nav -->
</header>

