<?php
	$title = 'Thêm/Sửa Sản Phẩm';
	$baseUrl = '../';

	require_once('../../masterial/layout/layout.php');
	$id = $msg = $title = $price = $weight = $status = $category_id = $date = $thumbnail = $description='';
	require_once('../../database/utility.php');
  
	require_once('form_save.php');
 

	require_once('../../database/define.php');
	require_once('../../database/dbhelper.php');
	
	$id = getGet('id');
   	if($id != '' && $id > 0) {
		$sql = "select * from product where id = '$id'";
		$productItem = executeResult($sql);
		if($productItem != null) {
			$title = $productItem['title'];
			$price = $productItem['price'];
			$weight = $productItem['weight'];
			$status = $productItem['status'];
			$description = $productItem['description'];
            $thumbnail = $productItem['thumbnail'];
            $category_id = $productItem['category_id'];
		} else {
			$id = 0;
		}
	} else {
		$id = 0;
	}

	$sql = "select * from category";
	//var_dump($sql);
	$categoryItems = executeResult($sql);
		?>
<div class="row" style="margin-top: 80px;">
	<div class="table-responsive" style="margin-left: 250px;">
		<h3>Thêm/Sửa Sản Phẩm</h3>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h5 style="color: red;"><?=$msg?></h5>
			</div>
			<div class="panel-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group">
					  <label for="usr">Tên sản phẩm:</label>
					  <input required="true" type="text" class="form-control" id="usr" name="title" value="<?=$title?>">
					  <input type="text" name="id" value="<?=$id?>" hidden="true">
					</div>
					
					<div class="form-group">
					  <label for="usr">Loại Sản Phẩm:</label>
					  <select class="form-control" name="category_id" id="category_id" required="true">
					  	<option value="">-- Chọn --</option>
					  	<?php
					  		foreach($categoryItems as $category) {
					  			if($category['id'] == $category_id) {
					  				echo '<option selected value="'.$category['id'].'">'.$category['name'].'</option>';
					  			} else {
					  				echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
					  			}
					  		}
					  	?>
					  </select>
					</div>
					<div class="form-group">
					  <label for="description">Mô tả sản phẩm:</label>
					  <input required="true" type="text" class="form-control" id="description" name="description" value="<?=$description?>">
					</div>
					
					<div class="form-group">
					  <label for="status">Trạng thái:</label>
					  <input required="true" type="number" class="form-control" id="status" name="status" value="<?=$status?>">
					</div>
					<div class="form-group">
					  <label for="price">Giá:</label>
					  <input required="true" type="number" class="form-control" id="price" name="price" value="<?=$price?>">
					</div>
					
					<div class="form-group">
					  <label for="weight">Khối lượng:</label>
					  <input required="true" type="number" class="form-control" id="weight" name="weight" value="<?=$weight?>">
					</div>
					<div class="form-group">
					  <label for="thumbnail">Hình ảnh sản phẩm:</label>
					  <input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?=$thumbnail?>">
					</div>
					
					
						
					 <div class="form-group">
					<button class="btn btn-success">Xác Nhận</button>
					</div>
					<!--
					<div class="form-group">
						  <label for="thumbnail">Hình ảnh sản phẩm:</label>
						  <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
						  <img id="thumbnail_img" src="<?=fixUrl($thumbnail)?>" style="max-height: 160px; margin-top: 5px; margin-bottom: 15px;">
					</div> -->

				</form>
			</div>
		</div>
	</div>
</div>
		</body>
	</html>
	
	





