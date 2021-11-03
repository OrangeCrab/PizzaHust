<?php
if(!empty($_POST)) {
	$id = getPost('id');
	$title = getPost('title');
	$price = getPost('price');
	$weight = getPost('weight');
	
	$thumbnail = getPost('thumbnail');
    $status = getPost('status');
    $date = getPost('date');
	$description = getPost('description');
	$category_id = getPost('category_id');
	

	if($id > 0) {
		//update
		if($thumbnail != '') {
			$sql = "update product set thumbnail = '$thumbnail', title = '$title', price = $price, status _id= '$status_id', description = '$description', date = '$date', weight = '$weight',category_id = '$category_id' where id = $id";
		} else {
			$sql = "update product set title = '$title', price = $price, status = $status, description = '$description', status = '$date', weight = '$weight',category_id = '$category_id' where id = $id";
		}
		
		execute($sql);

		header('location: ProductManagementPage.php');
		die();
	} else {
		//insert
		$sql = "insert into product(thumbnail, title, price, status, description, weight, category_id) values ('$thumbnail', '$title', '$price', '$status', '$description', '$weight', '$category_id')";
		execute($sql);

		header('location: ProductManagementPage.php');
		die();
	}
}