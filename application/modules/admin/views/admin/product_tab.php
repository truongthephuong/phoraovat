<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/25/2016
 * Time: 8:21 PM
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
        <a href="<?=base_url('admin/products')?>/list_cate" aria-controls="cate" role="tab" >Danh mục</a>
    </li>
    <li role="presentation" <?=$actSubList?>>
        <a href="<?=base_url('admin/products')?>/list_subcate" aria-controls="subcate" role="tab" >Danh mục con</a>
    </li>
    <li role="presentation" <?=$actSubList1?>>
        <a href="<?=base_url('admin/products')?>/list_subcate1" aria-controls="subcate1" role="tab" >Danh mục con 1</a>
    </li>
    <li role="presentation" <?=$actNews?>>
        <a href="<?=base_url('admin/products')?>/list_product" aria-controls="product" role="tab" >Sản phẩm - Dịch vụ</a>
    </li>
</ul>