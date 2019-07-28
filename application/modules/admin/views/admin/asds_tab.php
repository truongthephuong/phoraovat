<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 7/27/2019
 * Time: 9:52 PM
 */
$act = $this->router->fetch_method();
$actList = '';
$actSubList = '';
$actSubList1 = '';
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
    case 'list_subcate1' ;
    case 'addSubCate1' ;
    case 'subCateEdit1';
        $actSubList1 = 'class="active"';
        break;
    case 'list_product';
    case 'edit_product';
    case 'add_product';
        $actNews = 'class="active"';
        break;
    default:
        $actNews = 'class="active"';
        break;
}
?>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" <?=$actList?>>
        <a href="<?=base_url('admin/asds')?>/list_cate" aria-controls="cate" role="tab" >Danh mục</a>
    </li>
    <li role="presentation" <?=$actSubList?>>
        <a href="<?=base_url('admin/asds')?>/list_subcate" aria-controls="subcate" role="tab" >Danh mục con</a>
    </li>
    <li role="presentation" <?=$actSubList1?>>
        <a href="<?=base_url('admin/asds')?>/list_subcate1" aria-controls="subcate1" role="tab" >Danh mục con 1</a>
    </li>
    <li role="presentation" <?=$actNews?>>
        <a href="<?=base_url('admin/asds')?>/list_asds" aria-controls="product" role="tab" >Danh sách tin rao</a>
    </li>
</ul>