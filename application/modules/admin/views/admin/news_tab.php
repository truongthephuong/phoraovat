<?php
	$act = $this->router->fetch_method();
	$actList = '';
	$actSubList = '';
	$actNews = '';

	switch ($act) {
		case 'list_cate' ;
		case 'addCate' ;
		case 'cateEdit';
			$actList = 'class="active"';
			break;
		case 'list_subcate' ;
		case 'addSubCate' ;
		case 'subCateEdit';
			$actSubList = 'class="active"';
			break;
		case 'list_news';
		case 'edit_news';
		case 'add_news';
			$actNews = 'class="active"';
			break;
		default:
			$actNews = 'class="active"';
			break;
	}
?>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" <?=$actList?>><a href="<?php echo base_url('admin/news'); ?>/list_cate" aria-controls="cate" role="tab" >Danh mục</a></li>
    <li role="presentation" <?=$actSubList?>><a href="<?php echo base_url('admin/news'); ?>/list_subcate" aria-controls="subcate" role="tab" >Danh mục con</a></li>
    <li role="presentation" <?=$actNews?>><a href="<?php echo base_url('admin/news'); ?>/list_news" aria-controls="news" role="tab" >Tin tức</a></li>
</ul>