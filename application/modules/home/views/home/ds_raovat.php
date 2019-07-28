<!-- wapper -->
<!-- InstanceBeginEditable name="main" -->
<script src="<?=site_url()?>js/jquery.lazy.min.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function ($) {
        $('.lazy').Lazy({
            // your configuration goes here
            scrollDirection: 'vertical',
            effect: 'fadeIn',
            visibleOnly: true,
            onError: function(element) {
            console.log('error loading ' + element.data('src'));
            }
        });
    });
</script>
<div class="main-block">
    <div class="bg-black">  
        <div class="inner main-cont">
        <h2 class="title">Tin Rao Theo Danh Mục <?php echo $cateName;?></h2>
        <p></p>
        <div class="lstLeft"> 
            <?php
            if($arrProducts):
                foreach ($arrProducts as $asds):
                        
                    $imageThumb = '/img/no-img.png';
                    $imageLink = '/upload/asds/'.$asds->image;
                    if($asds->image != NULL){
                        $imageThumb = '/upload/asds/'.$asds->image;
                    }           
            ?>
                <div class="lstCate">
                    <a href="<?php echo site_url('/home/chi-tiet/'.$asds->id);?>">
                        <p class="title"><?= $asds->title ?></p>
                        <img src="<?=$imageThumb?>" class="lazy" alt="<?= $asds->title ?>" />
                        <span>
                            <?php echo _substr(html_entity_decode($asds->description), 400);?>
                        </span>
                    </a>
                </div>
                <div class="line"></div>
            <?php 
                endforeach;
            else:
                echo 'Không có tin rao nào';
            endif;    
            ?>
            <div class="row" id="pagination">
                <ul class="pagination tsc_pagination" style="float:left">
                   <?php 
                   	foreach ($paginations as $pagination) {
						echo "<li>". $pagination."</li>";
					} 
					?>
                </ul>
            </div>
            </div>
            <?php //var_dump($arrProductsRight);?>
            <div class="lstRight">
            <?php
            if($arrProductsRight): 
                foreach ($arrProductsRight as $asdsRight):
            	
                $imageThumb = '/img/no-img.png';
                $imageLink = '/upload/asds/'.$asdsRight->image;
                if($asdsRight->image != NULL){
                    $imageThumb = '/upload/asds/'.$asdsRight->image;
                }
            ?>
                <div class="lstCateRight">
                    <a href="<?php echo site_url('/home/chi-tiet/'.$asdsRight->id);?>">
                        <img src="<?=$imageThumb?>" class="lazy" alt="<?=$asdsRight->title?>" />
                        <?=$asdsRight->title?>
                    </a>
                </div>
            <?php
                endforeach;
            else: echo 'Không có tin rao nào';
            endif;
            ?>
            </div>
        </div>
            <!-- InstanceEndEditable -->
    </div>
</div>