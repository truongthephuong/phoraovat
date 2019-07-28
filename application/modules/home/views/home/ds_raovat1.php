<!-- wapper -->
            <!-- InstanceBeginEditable name="main" -->
<div class="main-block">
    <div class="bg-black">  
        <div class="inner main-cont">
        <h2 class="title">Tin Rao Theo Danh Mục <?php echo $subCateName;?></h2>
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
                        <img src="<?=$imageThumb?>" alt="no-img" />
                    </a>                                                      
                    <span>
                    	<a href="<?php echo site_url('/home/chi-tiet/'.$asds->id);?>">
                    		<?=$asds->title?>
                    	</a>
                    </span>
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
                        <img src="<?=$imageThumb?>" alt="no-img" />
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