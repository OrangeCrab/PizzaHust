<?php

if(!empty($_POST)) {
	$image = setImgAndGetImg_id();
	$id = getPost('id');
	$name = getPost('name');
	$price = getPost('price');
	$description = getPost('description');
	$category_id = getPost('category_id');
	$image_tmp_name = getTempName();

	if($id > 0) {
		
		$status_product_id = getPost('status_product_id');
		$getImage = "select image from product where id=$id";
		$result = getArrResult($getImage);
		$getImage = $result['image'];
		if($image != '') {
			$dir = "../../masterial/image/thuc_don";
			unlink($dir.'/'.$getImage);
			$sql = "update product set image = '$image', name = '$name', price = $price, 
			status_product_id= '$status_product_id', description = '$description',category_id = '$category_id' 
			where id = $id";
		} else {
			$sql = "update product set image = '$getImage', name = '$name', price = $price, status_product_id = $status_product_id, 
			description = '$description',category_id = '$category_id' where id = $id";
		}
		
		execute($sql);
		move_uploaded_file($image_tmp_name, "../../masterial/image/thuc_don/$image");
		header('location: ProductManagementPage.php');
		die();
	} else {
		foreach ($_POST['size'] as $key => $value) 
		{
			$get_id = $_POST['size'][$key];
			$price= $_POST[$get_id];
			$query = "select id from size where name='$get_id'";
			$size_id = getArrResult($query)['id'];
			$sql = "insert into product(image, name, price, status_product_id, description, category_id, size_id) values ('$image', '$name', '$price', '1', '$description', '$category_id', '$size_id')";
			execute($sql);
		}
		move_uploaded_file($image_tmp_name, "../../masterial/image/thuc_don/$image");
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