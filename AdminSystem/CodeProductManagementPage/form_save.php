<?php

if(!empty($_POST)) {
	$image = setImgAndGetImg_id();
	$id = getPost('id');
	$title = getPost('title');
	$price = getPost('price');
	$description = getPost('description');
	$category_id = getPost('category_id');
	$image_tmp_name = getTempName();

	if($id > 0) {
		
		$status_id = getPost('status_id');
		if($image != '') {
			$sql = "update product set image = '$image', title = '$title', price = $price, 
			status_id= '$status_id', description = '$description',category_id = '$category_id' 
			where id = $id";
		} else {
			$getImage = "select image from product where id=$id";
			$result = getArrResult($getImage);
			$getImage = $result['image'];
			$sql = "update product set image = '$getImage', title = '$title', price = $price, status_id = $status_id, 
			description = '$description',category_id = '$category_id' where id = $id";
		}
		
		execute($sql);
		move_uploaded_file($image_tmp_name, "../../masterial/image/product_image/$image");
		header('location: ProductManagementPage.php');
		die();
	} else {
		foreach ($_POST['size'] as $key => $value) 
		{
			$get_id = $_POST['size'][$key];
			$price= $_POST[$get_id];
			$query = "select id from size where name='$get_id'";
			$size_id = getArrResult($query)['id'];
			$sql = "insert into product(image, title, price, status_id, description, category_id, size_id) values ('$image', '$title', '$price', '1', '$description', '$category_id', '$size_id')";
			execute($sql);
		}
		move_uploaded_file($image_tmp_name, "../../masterial/image/product_image/$image");
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