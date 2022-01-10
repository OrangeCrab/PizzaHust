<?php
if (isset($_POST['logout'])){
	$_SESSION['admin_id'] = 0;
	header('location: ../login_form.php');
	die();
}
if(!empty($_POST)) {
	$image = setImgAndGetImg_id();
	$id = getPost('id');
	$name = getPost('name');
	$description = getPost('description');
	$category_id = getPost('category_id');

	$price_free_size = getPost('price_free_size');
	$price_s = getPost('price_s');
	$price_m = getPost('price_m');
	$price_l = getPost('price_l');

	$image_tmp_name = getTempName();

	if($id > 0) {
		
		$status_product_id = getPost('status_product_id');
		$getImage = "select image from product where id=$id";
		$result = getArrResult($getImage);
		$getImage = $result['image'];
		
		if($image != '') {
			$dir = "../../masterial/image/thuc_don";
			unlink($dir.'/'.$getImage);
			$sql = "update product set image = '$image', name = '$name', status_product_id= '$status_product_id', 
			description = '$description',category_id = '$category_id' ,price_free_size = '$price_free_size', 
			price_s = '$price_s', price_m = '$price_m', price_l = '$price_l' where id = $id";
		} else {
			$sql = "update product set image = '$getImage', name = '$name', status_product_id = $status_product_id, 
				description = '$description',category_id = '$category_id', price_free_size = '$price_free_size', 
				price_s = '$price_s', price_m = '$price_m', price_l = '$price_l' where id = $id";
		}
		
		execute($sql);
		move_uploaded_file($image_tmp_name, "../../masterial/image/thuc_don/$image");
		header('location: ProductManagementPage.php');
		die();
	} else {

		$sql = "insert into product(image, name, status_product_id, description, category_id, price_free_size, price_s, 
		price_m, price_l) values ('$image', '$name', '1', '$description', '$category_id', '$price_free_size', '$price_s', 
		'$price_m', '$price_l')";
		execute($sql);
		move_uploaded_file($image_tmp_name, "../../masterial/image/thuc_don/$image");

		$sql = "select * from product ORDER BY id DESC LIMIT 1";
		$id = getArrResult($sql)['id'];
		
		header('location: ProductManagementPage.php');
		die();
	}
}

function setImgAndGetImg_id()
{
	if (isset($_POST['confirm'])) {
		$image = $_FILES['image']['name'];
		return $image;
	}
}

function getTempName()
{
	if (isset($_POST['confirm'])) {
		$image = $_FILES['image']['tmp_name'];
		return $image;
	}
}