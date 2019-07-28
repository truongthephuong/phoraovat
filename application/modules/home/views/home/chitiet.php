<!-- wapper -->
            <!-- InstanceBeginEditable name="main" -->
<div class="main-block">
    <div class="bg-black">  
        <div class="inner main-cont">
        <h2 class="title">Chi Tiết Tin Rao</h2>
        <div class="detail"> 
            <?php 
                foreach ($detailProduct as $asds):
                        
                    $imageThumb = '/img/no-img.png';                                                    
                    $imageLink = '/upload/asds/'.$asds->image;
                                                
                    if($asds->image != NULL){
                        $imageThumb = '/upload/asds/'.$asds->image;
                    }                                                                   
            ?>
               
                <label><?=$asds->title?></label>
                <p>
                    <i>$ <?=$asds->price?></i>
                    <i><?php 
                        $localList = getField($asds->local_id,'locations_model','name');
                        
                        foreach($localList as $localName){ echo $localName->name.' / ';}
                        $sublocalList = getField($asds->sublocal_id,'sublocations_model','name');
                        foreach($sublocalList as $sublocalName){ echo $sublocalName->name;}
                    ?></i>
                    <i><?=$asds->created?></i>
                </p>
                <img src="<?=$imageThumb?>" alt="no-img" />

                <div class="row">
                    Giá : <?=$asds->price?>
                </div>

                <div class="line"></div>

                <div class="row">
                    <p>Liện hệ: 
                    <?php
                        $memTel = '';
                        $fullName = '';
                        $memList = getField($asds->mem_id,'members_model','fullname,tel');
                        
                        foreach($memList as $memName){ echo $fullName = $memName->fullname;$memTel=$memName->tel;}
                    ?>
                    </p>
                    <p>Điện thoại: <?=$memTel?></p>
                </div>

                <div class="line"></div>

                <div class="row">
                    <p><?=html_entity_decode($asds->description)?></p>
                    <p><?=html_entity_decode($asds->detail)?></p>
                </div><br />
                <p class="title">Tin rao cùng loại của <?=$fullName?></p>
                <div class="line"></div>
            <?php endforeach; ?>

<!--Begin show more Product list-->
                
                <?php       
                    foreach ($moreProducts as $asds):
                            
                        $imageThumb = '/img/no-img.png';                                                    
                        $imageLink = '/upload/asds/'.$asds->image;
                                                    
                        if($asds->image != NULL){
                            $imageThumb = '/upload/asds/'.$asds->image;
                        }                                                                  
                ?>
                    <div class="lstMore">
                        <a href="<?php echo site_url('/home/chitiet/'.$asds->id);?>">
                            <p class="title"><?=$asds->title?></p>
                            <img src="<?=$imageThumb?>" alt="no-img" />
                        </a>                                                      
                        <span>
                            <a href="<?php echo site_url('/home/chitiet/'.$asds->id);?>">
                                <?=$asds->title?>
                            </a>
                        </span>
                    </div>
                    <div class="line"></div>
                <?php endforeach; ?>
                
<!--End show more Product list-->
            </div>

            <div class="lstRight">
            <?php foreach ($arrProductsRight as $asdsRight):?>

            <?php
                $imageThumb = '/img/no-img.png';                                                    
                $imageLink = '/upload/asds/'.$asdsRight->image;
                                                
                if($asdsRight->image != NULL){
                    $imageThumb = '/upload/asds/'.$asdsRight->image;
                }           
            ?>
                <div class="lstCateRight">
                    <a href="<?php echo site_url('/home/chitiet/'.$asdsRight->id);?>">
                        <img src="<?=$imageThumb?>" alt="no-img" />
                        <?=$asdsRight->title?>
                    </a> 
                    
                </div>
            <?php endforeach; ?>
            </div>


        </div>
            <!-- InstanceEndEditable -->
    </div>
</div>