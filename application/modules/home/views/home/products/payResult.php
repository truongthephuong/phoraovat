<style>
    .prod_list{
        font-size: 0.8em;
        font-weight: bold;
        /* background-color: #fcf;*/
    }
    .prod_list a{
        color: #000080;
        display: block;
    }
    .prod_list:hover {
        background-color: #e9e9e9;
        border: 1px solid #a1a1a1;
        border-radius: 10px;
    }

</style>
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
    <div class="row lstLeft">
        <div class="span9 blog">
            <?php
            if($this->session->flashdata('pay_order')) {
                echo '<h3 class="title-bg"><a href="#">' . $this->session->flashdata('pay_order') . '</a></h3>';
            }
            ?>
        </div>

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
