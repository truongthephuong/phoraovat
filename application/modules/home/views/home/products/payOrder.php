<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30-Sep-17
 * Time: 8:30 PM
 */
$cnt = 0;
?>

<style type="text/css">

    /* -- $error -- */
    .error {
        background: transparent url(<?=site_url()?>img/error.gif) no-repeat scroll 0 8px;
        color: #e84c3d;
        /*display: block;*/
        padding: 5px 0 0 20px;
    }
    input.error {
        background: none;
    }
    .log-fill .error {
        background-position: 125px 7px;
    }
</style>

<script src="<?php echo base_url() ?>js/jquery.validate.js"></script>

<script>
    $().ready(function(){
        $('#fullname').focus();
        $('#frmOrder').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    maxlength: 128
                },
                fullname: {
                    required: true,
                    minlength: 6,
                    maxlength: 32
                },
                phone: {
                    required: true,
                    minlength: 8,
                    maxlength: 50
                }
            },
            messages: {
                fullname: {
                    required: "Nhập họ và tên"
                },
                email: {
                    required: "Nhập địa chỉ email",
                    email: "Email không đúng định dạng"
                },
                phone: "Nhập số điện thoại"
            }
        });
    });
</script>

<div class="container">
    <div class="row">
    <?php if ($orderInfo != NULL) :?>
        <div class="span9 blog">
            <article>
                <h3 class="title-bg"><?=$title?></h3>
                <div class="post-content">
                    <table border="0" width="100%" style="border-collapse: collapse;" cellpadding="5px" cellspacing="3px" class="fh5co-pricing-table">
                        <thead style="background-color: #fcf">
                        <th>STT</th>
                        <th nowrap="nowrap">Hình ảnh</th>
                        <th nowrap="nowrap">Tên sản phẩm</th>
                        <th nowrap="nowrap">Giá tiền</th>
                        <th nowrap="nowrap">Số lượng</th>
                        <th>Tổng tiền</th>
                        </thead>
                        <?php
                        $width = '80';
                        $tbName = 'products';
                        $condField = 'id';
                        $fieldName = 'fcate_id, title, price, created, image';
                        $priceTotal = 0;
                        $orderTotal = 0;
                        foreach ($orderInfo as $oInfo):
                            $cnt++;
                            $detailProd = get1Field($condField,$oInfo->product_id,$tbName,$fieldName);
                            $thumbImg = image_thumb( 'products/', $detailProd[0]->image, $width, 'upload/');
                            ?>
                            <tr style="background-color: #F8FCFF">
                                <td width="10%" valign="middle" align="center">
                                    <?php echo $cnt;?>
                                </td>

                                <td width="18%" valign="top" align="center">
                                    <img src="/<?=$thumbImg?>" alt="<?=html_entity_decode($detailProd[0]->title)?>">
                                </td>
                                <td width="18%" valign="middle" align="center">
                                    <a href="#"><?php echo $detailProd[0]->title;?></a>
                                </td>
                                <td width="18%" valign="middle" align="center">
                                    <?php echo number_format($oInfo->price);?>đ
                                </td>
                                <td width="18%" valign="middle" align="center">
                                    <?php echo $oInfo->quantity;?>
                                </td>
                                <td width="18%" valign="middle" align="center">
                                    <?php
                                    $priceTotal = intval($oInfo->price)*intval($oInfo->quantity);
                                    $orderTotal += $priceTotal;
                                    echo number_format($priceTotal).'đ';
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        <tr style="background-color: #ecfbda">
                            <td colspan="5" style="text-align: right"><label style="color: #d8450b"><h4>Tổng cộng </h4></label></td>
                            <td valign="middle" align="center"><label style="color: #d8450b"><?php echo number_format($orderTotal); ?>đ</label></td>
                        </tr>
                    </table>
                </div>

                <form method="post" action="" id="frmOrder">
                    <div class=" span4" style="text-align: right;">
                        <label for"fullname">
                        Họ và tên :
                        <input type="text" name="fullname" id="fullname" placeholder="Họ và tên"/>
                        </label>
                        <label>
                        Địa chỉ email :
                        <input type="text" name="email" id="email" placeholder="Đia chỉ email"/>
                        </label>
                        <label>
                        Số điện thoại :
                        <input type="text" name="phone" id="phone" placeholder="Số điện thoại"/>
                        </label>
                    </div>
                    <div class="span4 ">
                        <textarea style="width: 115%" rows="6" name="detail" placeholder="Ghi chú"></textarea>

                        <input type="submit" name="bntorder" class="btn" value="Đặt Mua" id="submit"/>
                        <p id="text-contact"> Chúng tôi rất cảm ơn quý khách hàng đã tin tưởng sản phẩm của chúng tôi, Nếu có bất cứ thắc mắc nào,
                            mời quý khách liên hệ với chúng tôi tại trang Liên Hệ.
                        </p>
                    </div>
                </form>
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