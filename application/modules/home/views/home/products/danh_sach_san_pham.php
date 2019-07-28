<div class="container">
	<div class="row lstLeft">
	<?php
		if($arrProducts):
		foreach ($arrProducts as $prod):

		$imageThumb = '/img/no-img.png';
		$imageLink = '/upload/products/'.$prod->image;
		if($prod->image != NULL){
			$imageThumb = image_thumb( 'products/', $prod->image, $width, 'upload/');
		}
	?>
		<div class="lstCate">
			<a href="<?php echo site_url('/home/chi-tiet-san-pham/'.$prod->id);?>">
				<p class="title"><?= $prod->title ?></p>
				<img src="<?=$imageThumb?>" class="lazy" alt="<?= $prod->title ?>" />
			</a>
			<span>
               	<a href="<?php echo site_url('/home/chi-tiet-san-pham/'.$prod->id);?>">
               		<?php echo _substr(html_entity_decode($prod->description), 400);?>
               	</a>
			</span>
		</div>
		<div class="line"></div>
	<?php
		endforeach;
	?>
		<div class="row pagination" id="pagination">
			<ul >
			<?php
				foreach ($paginations as $pagination) {
					echo "<li>". $pagination."</li>";
				}
			?>
			</ul>
		</div>
	<?php
		else:
			echo 'Không có sản phẩm nào';
		endif;
	?>
	</div>
</div>