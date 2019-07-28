<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30-Sep-17
 * Time: 8:30 PM
 */
$cnt = 0;
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/assets/alertify.core.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/assets/alertify.default.css" id="toggleCSS">
<script src="<?=site_url()?>js/assets/alertify.min.js" type="text/javascript"></script>
<script>
	var order = function (pId) {
    alertify.confirm('Bạn chắc chắn mua sản phẩm nầy ?', function (e) {
        if (e) {
            //after clicking OK;
            alertify.success('Cám ơn bạn đã mua sản phẩm');
            window.location = '<?=site_url('/')?>home/mua-san-pham/' + pId;
        } else {
            //after clicking Cancel
            alertify.error('Bạn đã chọn hủy mua sản phẩm');
        }
    });
}
</script>
<div class="container">
	<div class="row">
        <?php if ($orderInfo != NULL) :?>
            <div class="span9 blog">
			<article>
				<h3 class="title-bg"><a href="#"><?=$title?></a></h3>
                <div class="post-content">
                    <table border="1" width="100%" style="border-collapse: collapse;" cellpadding="3px"
                           cellspacing="3px" class="fh5co-pricing-table">
                        <thead>
                        <th>STT</th>
                        <th nowrap="nowrap">Hình ảnh</th>
                        <th nowrap="nowrap">Tên sản phẩm</th>
                        <th nowrap="nowrap">Giá tiền</th>
                        <th nowrap="nowrap">Số lượng</th>
                        <th>Xóa</th>
                        </thead>
                        <?php
                        $width = '80';
                        $tbName = 'products';
                        $condField = 'id';
                        $fieldName = 'fcate_id, title, price, created, image';
                        foreach ($orderInfo as $oInfo):
                            $cnt++;
                            $detailProd = get1Field($condField, $oInfo->product_id, $tbName, $fieldName);
                            //echo '<pre>';
                            //print_r($oInfo->product_id);
                            //die;
                            $thumbImg = image_thumb('products/', $detailProd[0]->image, $width, 'upload/');
                            ?>
                            <tr>
                                <td width="10%" valign="middle">
                                    <?php echo $cnt; ?>
                                </td>

                                <td width="18%" valign="top" align="center">
                                    <img src="/<?= $thumbImg ?>" alt="<?= html_entity_decode($detailProd[0]->title) ?>">
                                </td>
                                <td width="18%" valign="middle" align="center">
                                    <a href="#"><?php echo $detailProd[0]->title; ?></a>
                                </td>
                                <td width="18%" valign="middle" align="center">
                                    <?php echo number_format($oInfo->price); ?>đ
                                </td>
                                <td width="18%" valign="middle" align="center">
                                    <?php echo $oInfo->quantity; ?>
                                </td>
                                <td width="18%" valign="middle" align="center">
                                    <a href="<?= site_url('/home/delete_order/' . $oInfo->product_id) ?>" class="btn">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="6" style="text-align: right">
                                <a href="<?= site_url('/home/list-products') ?>" class="btn">Tiếp tục mua hàng</a>
                                <a href="<?= site_url('/home/payOrder/' . getTransactionCookie()) ?>" class="btn">Thanh
                                    toán</a></td>
                        </tr>
                    </table>
                    <div><label style="color: #d8450b">
                            <h4><?php echo ($this->session->flashdata("orderStatus")) ? $this->session->flashdata("orderStatus") : ''; ?></h4>
                        </label></div>
                </div>
            </article>
        </div>
        <?php else : ?>
            <div class="span9 blog">Không tìm thấy sản phẩm nào </div>
        <?php endif; ?>
        <div class="span3 sidebar">
            <!--Search-->
            <section>
                <div class="input-append">
                    <form action="#">
                        <input id="appendedInputButton" size="16" type="text" placeholder="Tìm kiếm"><button class="btn" type="button"><i class="icon-search"></i></button>
                    </form>
                </div>
            </section>

            <!--Categories-->
            <h5 class="title-bg">Danh mục sản phẩm</h5>
            <ul class="post-category-list">
                <?php
                foreach ($arrCategory as $cateValue => $cateName) :
                    echo '<li><a href="'.site_url("/home/danh-sach-san-pham/".convert_vi_to_en(delComar($cateName))."-". $cateValue.".html").'"><i class="icon-plus-sign"></i>'.$cateName.'</a></li>';
                endforeach;
                ?>
            </ul>
            <!--Popular Posts-->
            <h5 class="title-bg">Sản phẩm xem nhiều</h5>
            <ul class="popular-posts">
                <?php
                $width = '80';
                foreach ($viewProducts as $itemProd):
                    $thumbImg = image_thumb( 'products/', $itemProd->image, $width, 'upload/');
                    ?>
                    <li class="prod_list">
                        <a href="<?php echo site_url('/home/chi-tiet-san-pham/'.convert_vi_to_en(delComar($itemProd->title))."-".$itemProd->id.".html"); ?>" style="color: #d8450b;font-weight: bold;">
                            <img src="/<?=$thumbImg?>" alt="<?=html_entity_decode($itemProd->title)?>">
                        </a>
                        <h6><a href="<?php echo site_url('/home/chi-tiet-san-pham/'.convert_vi_to_en(delComar($itemProd->title))."-".$itemProd->id.".html"); ?>" style="color: #d8450b;font-weight: bold;">
                                <?=html_entity_decode($itemProd->title)?>
                            </a></h6>
                        <em>Đăng ngày <?=$itemProd->created?></em>
                    </li>
                    <?php
                endforeach;
                ?>
            </ul>

        </div>
    </div>
</div>