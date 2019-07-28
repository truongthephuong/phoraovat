<!-- wapper -->
<script src="<?=site_url()?>js/components.js" type="text/javascript"></script>
<!-- InstanceBeginEditable name="main" -->
<div class="main-block">
	<div class="bg-black">
		<div class="inner main-cont">
			<h2 class="title" style="color: #086eb8">Tin Rao Hiện Có </h2>
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
								<p class="title"><?php echo $asds->title; ?></p>
								<img src="<?php echo $imageThumb;?>" alt="no-img" />
							</a>
							<span>
		                        <a href="<?php echo site_url('/home/chi-tiet/'.$asds->id);?>">
		                            <?php echo _substr(html_entity_decode($asds->description), 400);?>
		                        </a>
		                    </span><br />
							<span style="text-align: right">
								<a href="<?php echo site_url('/home/them-tin-rao/'.$asds->id);?>" style="color: #086eb8" title="Chỉnh sửa tin rao">
									Chỉnh sửa
								</a> |
								<a href="#" onclick="comObj.update('<?php echo site_url('/home/refreshAsds/'.$asds->id);?>');" style="color: #086eb8" title="Làm mới tin rao">
									Làm mới tin rao
								</a> |
								<a href="<?php echo site_url('/home/deleteAsd/'.$asds->id);?>" style="color: #b81509" title="Xóa tin rao">
									Xóa tin rao
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
		</div>
		<!-- InstanceEndEditable -->
	</div>
</div>