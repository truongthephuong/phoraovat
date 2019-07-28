<?php
	$width = '450';
	$nullConts = 'Đang cập nhật';
	foreach ($detailProduct as $dProduct) :
		$thumbImg       = ($dProduct->image != NULL) ? image_thumb( 'products/', $dProduct->image, $width, 'upload/') : '';
		$title          = ($dProduct->title != NULL) ? html_entity_decode($dProduct->title) : $nullConts;
		$description    = ($dProduct->description != NULL) ? html_entity_decode($dProduct->description) : $nullConts;
		$detail         = ($dProduct->detail != NULL) ? html_entity_decode($dProduct->detail) : $nullConts;
		$post_date      = ($dProduct->created != NULL) ? html_entity_decode($dProduct->created) : $nullConts;
		$views          = ($dProduct->count_view != NULL) ? html_entity_decode($dProduct->count_view) : $nullConts;
		$pId            = ($dProduct->id != NULL) ? $dProduct->id : $nullConts;
		$price          = ($dProduct->price != NULL) ? $dProduct->price : $nullConts;
		$code           = ($dProduct->code != NULL) ? $dProduct->code : $nullConts;
		$mode           = ($dProduct->model != NULL) ? $dProduct->model : $nullConts;
		$created        = ($dProduct->created != NULL) ? date("d/m/Y", strtotime($dProduct->created)) : $nullConts;
	endforeach;

?>
<style>
    .detail-product {
        background-color: #fcf;
        width: 69.9%;
        padding: 10px 5px 10px 0;
        position: relative;
        float: left;
    }

    .right-product {
        background-color: #8fdf82;
        width: 30%;
        padding: 10px 0 10px 5px;
        position: relative;
        float: left;
    }

    .inner-product {
        background-color: #0A7EC5;
        margin: 0 auto;
        max-width: 1020px;
    }

    .post-summary-footer {float: none; margin-bottom: 20px;}
    ul.post-data {float: none; clear: both; margin: 0px; list-style: none;}
    ul.post-data li:last-child {
        -o-text-overflow: ellipsis;
        text-overflow:    ellipsis;
        overflow:hidden;
        white-space:nowrap;
        width: auto;
    }
</style>
<!--link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-responsive.css"-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/assets/alertify.core.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/assets/alertify.default.css" id="toggleCSS">
<script src="<?php echo site_url(); ?>js/assets/alertify.min.js" type="text/javascript"></script>
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
<div class="main-block">
		<div class="inner">
			<div class="detail-product">
				<article>
					<h3 class="title"><a href="#"><?=$title?></a></h3>
                    <table border="0" width="90%" style="border-collapse: collapse;" cellpadding="3px" cellspacing="3px">
                        <tr>
                            <td width="50%" valign="top">
                                <img src="/<?=$thumbImg?>" alt="Post Thumb" align="middle;">
                            </td>

                            <td width="50%" valign="top" align="left">
                                <div >
                                    <?php
                                    echo ($description != NULL) ? $description : '' ;
                                    ?>
                                    <ul >
                                        <li><label>Mã số : <?=$code ?> </label></li>
                                        <li><label>Kiểu : <?=$mode ?> </label></li>
                                        <li><label>Giá : <?=$price ?> vnd</label></li>
                                        <li><label>Ngày đăng : <?=$created ?> </label></li>
                                        <li><label>Lượt xem : <?=$views ?> </label></li>
                                    </ul>
                                    <p><a href="javascript:order('<?=$pId?>');" ><img src="/images/muangay.png" style="width: 120px; height: 40px"></a></p>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="post-body">
                        <?=html_entity_decode($detail)?>
                    </div>

                    <div class="post-summary-footer">
                        <ul class="post-data">
                            <li><i class="icon-calendar"></i> <?=$post_date?></li>
                            <li><i class="icon-user"></i> <a href="/index.php">PhoRaoVat</a></li>
                            <li><i class="icon-comment"></i> <a href="#"><?=$views?> xem tin</a></li>
                            <li><i class="icon-tags"></i>
                                <a href="/home/list_news/food.html">Ẩm thực</a>,
                                <a href="/home/list_news/health.html">Sức khỏe</a>,
                                <a href="/home/list_news/fruit.html">Trái cây</a>
                            </li>
                        </ul>
                    </div>
				</article>
			</div>

            <div class="right-product">
                <!--Categories-->
                <h5 class="title">Danh mục sản phẩm</h5>
                <ul class="post-category-list">
                    <?php
                    foreach ($arrCategory as $cateValue => $cateName) :
                        echo '<li><a href="'.site_url("/home/danh-sach-san-pham/".convert_vi_to_en(delComar($cateName))."-". $cateValue.".html").'"><i class="icon-plus-sign"></i>'.$cateName.'</a></li>';
                    endforeach;
                    ?>
                </ul>
                <!--Popular Posts-->
                <h5 class="title">Sản phẩm cùng loại</h5>
                <ul class="popular-posts">
                    <?php
                    $width = '80';
                    foreach ($moreProducts as $itemProd):
                        $thumbImg = image_thumb( 'products/', $itemProd->image, $width, 'upload/');
                        ?>
                        <li>
                            <a href="#">
                                <img src="/<?=$thumbImg?>" alt="<?=html_entity_decode($itemProd->title)?>">
                            </a>
                            <h6><a href="<?php echo site_url('/home/chi-tiet-san-pham/'.convert_vi_to_en(delComar($itemProd->title))."-".$itemProd->id.".html"); ?>">
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