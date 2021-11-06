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
	
	echo $image;
	echo $id;
	echo $title;
	echo $price;
	echo $status_id;
	echo $date;
	echo $description;
	echo $category_id;

	if($id > 0) {
		//update
		if($image != '') {
			$sql = "update product set image = '$image', title = '$title', price = $price, 
			status_id= '$status_id', description = '$description', date = '$date',category_id = '$category_id' 
			where id = $id";
		} else {
			$sql = "update product set title = '$title', price = $price, status = $status_id, 
			description = '$description',category_id = '$category_id' where id = $id";
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
		$errors= array();
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_tmp = $_FILES['image']['tmp_name'];
		$file_type = $_FILES['image']['type'];
		$file_parts =explode('.',$_FILES['image']['name']);
		$file_ext=strtolower(end($file_parts));
		$extensions= array("jpeg","jpg","png");

		if(in_array($file_ext,$extensions)=== false){
			$errors[]="Chỉ hỗ trợ upload file JPEG hoặc PNG.";
		}
		if($file_size > 2097152) {
			$errors[]='Kích thước file không được lớn hơn 2MB';
		}

		$conn = mysqli_connect(HOST,USERNAME, PASSWORD, DATABASE);
		mysqli_set_charset($conn,'utf8');

		$image = $_FILES['image']['name'];
		$target = "../../masterial/image/thuc_don/".basename($image);
		$sql = "INSERT INTO images (image) VALUES ('$image')";

		mysqli_query($conn, $sql);
		mysqli_close($conn);

		return $image;
	}
}