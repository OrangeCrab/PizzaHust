<?php
	//$title = 'Thêm/Sửa Sản Phẩm';
	$baseUrl = '../';

	require_once('../../masterial/layout/layout.php');
	require_once('../../database/utility.php');
    $id = $msg = $title = $price = $weight = $status = $category_id = $date = $thumbnail = $description='';
	require_once('form_save.php');
    $id = getGet('id');

	require_once('../../database/define.php');
	require_once('../../database/dbhelper.php');

   	if($id != '' && $id > 0) {
		$sql = "select * from product where id = '$id'";
		$userItem = executeResult($sql);
		if($userItem != null) {
			$title = $userItem['title'];
			$price = $userItem['price'];
			$weight = $userItem['weight'];
			$status = $userItem['address'];
			$description = $userItem['description'];
            $thumbnail = $userItem['thumbnail'];
            $category_id = $userItem['category_id'];
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
	<div class="col-md-12 table-responsive">
		<h3>Thêm/Sửa Sản Phẩm</h3>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h5 style="color: red;"><?=$msg?></h5>
			</div>
			<div class="panel-body">
				<form method="post" onsubmit="return validateForm();">
					<div class="form-group">
					  <label for="usr">Tên sản phẩm:</label>
					  <input required="true" type="text" class="form-control" id="usr" name="title" value="<?=$title?>">
					  <input type="text" name="id" value="<?=$id?>" hidden="true">
					</div>
					<div class="form-group">
					  <label for="usr">Category:</label>
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
					
					<button class="btn btn-success">Xác Nhận</button>
				</form>
			</div>
		</div>
	</div>
</div>
		</body>
	</html>
	
	



<script type="text/javascript">
	function updateThumbnail() {
		$('#thumbnail_img').attr('src', $('#thumbnail').val())
	}
</script>
<script>
  $('#description').summernote({
    placeholder: 'Nhập nội dung dữ liệu',
    tabsize: 2,
    height: 300,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });
</script>

