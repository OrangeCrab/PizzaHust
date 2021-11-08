<?php

if(!empty($_POST)) {
	$image = setImgAndGetImg_id();
	$id = getPost('id');
	$title = getPost('title');
	$price = getPost('price');

    $status_id = getPost('status_id');
    $date = getPost('date');
	$description = getPost('description');
	$category_id = getPost('category_id');

	if($id > 0) {
		if($image != '') {
			$sql = "update product set image = '$image', title = '$title', price = $price, 
			status_id= '$status_id', description = '$description', date = '$date',category_id = '$category_id' 
			where id = $id";
		} else {
			$getImage = "select image from product where id=$id";
			$result = getArrResult($getImage);
			$getImage = $result['image'];
			$sql = "update product set image = '$getImage', title = '$title', price = $price, status_id = $status_id, 
			description = '$description', date = '$date', category_id = '$category_id' where id = $id";
		}
		
		execute($sql);
		header('location: ProductManagementPage.php');
		die();
	} else {
		//insert
		$sql = "insert into product(image, title, price, status_id, description, category_id) values ('$image', '$title', '$price', '$status_id', '$description', '$category_id')";
		execute($sql);

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