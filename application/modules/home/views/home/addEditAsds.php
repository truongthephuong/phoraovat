<!-- wapper -->
<!-- InstanceBeginEditable name="main" -->
<script type='text/javascript' src="<?php echo base_url()?>js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>bootstrap/css/bootstrap-toggle.min.css" />
<script type='text/javascript' src="<?php echo base_url()?>bootstrap/js/bootstrap-toggle.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="<?php echo base_url()?>css/style.css"/>
<!--<link rel="stylesheet" href="<?php /*echo base_url()*/?>bootstrap/css/bootstrap.min.css"/>-->
<script type='text/javascript' src="<?php echo base_url()?>js/simpleCalendar.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/simpleCalendar.css" />
<script type='text/javascript' src="<?php echo base_url()?>js/tinymce/tinymce.min.js"></script>
<script type='text/javascript' src="<?php echo base_url()?>js/components.js"></script>
<script>
	tinymce.init({ selector:'textarea' });
	$().ready(function() {

		var curImg = '<?php echo (isset($image)) ? $image : ""?>';
		$('#i_file').change( function(event) {
			var tmppath = URL.createObjectURL(event.target.files[0]);
			$("#tmpImg").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
		});
		//alert(curImg);
		if(curImg != ""){
			$("#tmpImg").fadeIn("fast").attr('src','/upload/asds/'+curImg);
		}
		calendar.set("created");
		//calendar.set("endDate");

	});

</script>
<?php
if($errors != ""){
	echo $errors;
}
$baseUrl = '';
if(isset($addNew)){
	$baseUrl =  base_url('home').'/addNew';
}else{
	$baseUrl = base_url('home').'/addEditAsds/'.$uID;
}
?>
<div class="main-block">
	<div class="inner main-cont">
		<div class="panel-body">
			<p><h2 class="title" style="color: #086eb8"><?php echo $caption;?></h2></p>
			<div id='loadingsearch' class="tcenter" style='display:none'>
				<img style="width:auto; display:inline-block;" src='<?=base_url()?>images/loading2.gif'/>
			</div>
			<div class="row">
				<form method="post" action="<?php echo $baseUrl?>" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group form-group-sm" style="padding: 3px 0 3px 0;">
						<div class="col-sm-12" style="padding: 3px 0 3px 0;">
							<label class="control-label" for="name" style="font-size: 0.8em;font-weight: bold">Danh mục: </label>
						<?php
							//$arrCate = getArrOpt( 'categories_model' , 'getAll');
							$js = array(
								'id'       => 'category',
								'onChange' => "comObj.changeCategory('".base_url('admin/ajaxChange')."')",
								'class'    => 'form-control'
							);
							echo form_dropdown('fcate_id', $arrOpt,(isset($fcate_id)) ? $fcate_id : 0 , $js);

						echo '<label class="control-label" for="name" style="font-size: 0.8em;font-weight: bold">Danh mục con : </label>';

							//print_r($arrSubOpt);exit;
							$js = array(
								'id'       => 'subcategory',
								'onChange' => "comObj.changeSubCategory('".base_url('admin/ajaxChange')."')",
								'class'    => 'form-control'
							);
							echo form_dropdown( 'cate_id' , $arrSubOpt , (isset($cate_id)) ? $cate_id : 0 , $js);

							echo '<label class="col-sm-2 control-label" for="name" style="font-size: 0.8em;font-weight: bold">Danh mục con cấp 1: </label>';
							$js = array(
								'id'       => 'sub2category',
								'class'    => 'form-control'
							);
							echo form_dropdown( 'subcate_id' , $arrSubOpt , (isset($subcate_id)) ? $subcate_id : '' , $js);
						?>
						</div>
					</div>

					<div class="form-group form-group-sm" style="padding: 3px 0 3px 0;">
						<div class="col-sm-3" >
							<label class="control-label" for="name" style="font-size: 0.8em;font-weight: bold">Tên SP :</label>
							<input type="text" class="form-control" size="50" name="name" value="<?php echo (isset($name)) ? $name : '' ?>" placeholder="News Title">
						</div>
					</div>

					<div class="form-group form-group-sm" style="padding: 3px 0 3px 0;">
						<div class="col-sm-3">
							<label class="control-label" for="Description" style="font-size: 0.8em;font-weight: bold">Mô tả :</label>
							<textarea name="description" placeholder="Mô tả tin rao">
								<?php echo (isset($description)) ? $description : '' ?>
							</textarea>
						</div>
					</div>

					<div class="form-group form-group-sm" style="padding: 3px 0 3px 0;">
						<div class="col-sm-12">
							<label class="control-label" for="detail" style="font-size: 0.8em;font-weight: bold">Chi tiết :</label>
							<?php echo form_textarea('content', (isset($detail)) ? $detail : '', "class = 'ckeditor'")
							//echo $this->ckeditor->editor('content',($news->content) ? $news->content : '');
							?>

						</div>
					</div>

					<div class="form-group form-group-sm" style="padding: 3px 0 3px 0;">
						<div class="col-sm-12">
							<label class="control-label" for="price" style="font-size: 0.8em;font-weight: bold">Giá :</label>
							<input type="text" class="form-control" size="50" name="price" value="<?php echo (isset($price)) ? $price : '' ?>" placeholder="Product Prices">
							<label class="control-label" for="price1" style="font-size: 0.8em;font-weight: bold">Giá KM:</label>
							<input type="text" class="form-control" size="50" name="promo" value="<?php echo (isset($promo)) ? $promo : '' ?>" placeholder="Product Prices Promotion">
							<label class="control-label" for="rank" style="font-size: 0.8em;font-weight: bold">Thứ tự :</label>
							<input type="text" class="form-control" size="10" name="rank" value="<?php echo (isset($rank)) ? $rank : '' ?>" placeholder="Rank">
						</div>
					</div>

					<div class="form-group form-group-sm" style="padding: 3px 0 3px 0;">
						<div class="col-sm-12">
							<label class="control-label" for="date" tyle="font-size: 0.8em;font-weight: bold">Ngày đăng :</label>
							<input type="text" class="form-control" name="created" id="created" value="<?php echo (isset($created)) ? $created : '' ?>" placeholder="Created date">
							<label class="control-label" for="status" style="font-size: 0.8em;font-weight: bold">Trạng thái :</label>
							<input type="checkbox" name="status" <?php echo (isset($status) && $status == '1') ? 'checked' : '' ?> data-toggle="toggle" data-on="ENABLED" data-off="DISABLED" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="120px">
							<br /><br />
							<label class="col-sm-2 control-label" for="images" style="font-size: 0.8em;font-weight: bold">Hình ảnh :</label>
							<input type="file" id="i_file" value="" name="img"><br />
							<img id="tmpImg" src="" style="display:none;width:200px" />
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal" id="bntBack">Cancel</button>
						<button type="submit" class="btn btn-primary" value="saveEdit" name="saveEdit">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>