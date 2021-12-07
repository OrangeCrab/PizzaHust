<?php

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

	$price = 0;
	if ($price_free_size > 0) {
		$price = $price_free_size;
	}else {
		if ($price_s > 0) {
			$price = $price_s;
		}else {
			if ($price_m > 0) {
				$price = $price_m;
			}else {
				$price = $price_l;
			}
		}
	}

	if($id > 0) {
		
		$status_product_id = getPost('status_product_id');
		$getImage = "select image from product where id=$id";
		$result = getArrResult($getImage);
		$getImage = $result['image'];
		if($image != '') {
			$dir = "../../masterial/image/thuc_don";
			unlink($dir.'/'.$getImage);
			$sql = "update product set image = '$image', name = '$name', price = $price, 
			status_product_id= '$status_product_id', description = '$description',category_id = '$category_id' ,
			price_free_size = '$price_free_size', price_s = '$price_s', price_m = '$price_m', price_l = '$price_l'
			where id = $id";
		} else {
			$sql = "update product set image = '$getImage', name = '$name', price = $price, status_product_id = $status_product_id, description = '$description',category_id = '$category_id', price_free_size = '$price_free_size', price_s = '$price_s', price_m = '$price_m', price_l = '$price_l' where id = $id";
		}
		
		execute($sql);

		$sql = "delete from meal_detail where product_id = "."'".$id."'";
		execute($sql);
		$sql = "delete from menu_detail where product_id = "."'".$id."'";
		execute($sql);

		$meals = (isset($_POST['meal'])) ? $_POST['meal'] : array();

		if (count($meals) > 0) {
			foreach ($meals as $meal) { 
				$sql = "insert into meal_detail(meal_id,product_id) values ('$meal','$id')";
				execute($sql);
			} 
		}

		$menus = (isset($_POST['menu'])) ? $_POST['menu'] : array();

		if (count($menus) > 0) {
			foreach ($menus as $menu) { 
				$sql = "insert into menu_detail(menu_id,product_id) values ('$menu','$id')";
				execute($sql);
			} 
		}
		move_uploaded_file($image_tmp_name, "../../masterial/image/thuc_don/$image");
		header('location: ProductManagementPage.php');
		die();
	} else {

		$sql = "insert into product(image, name, price, status_product_id, description, category_id, price_free_size, price_s, price_m, price_l) 
				values ('$image', '$name', '$price', '1', '$description', '$category_id', '$price_free_size', '$price_s', '$price_m', '$price_l')";
		execute($sql);
		move_uploaded_file($image_tmp_name, "../../masterial/image/thuc_don/$image");

		$sql = "select * from product ORDER BY id DESC LIMIT 1";
		$id = getArrResult($sql)['id'];

		$meals = (isset($_POST['meal'])) ? $_POST['meal'] : array();

		if (count($meals) > 0) {
			foreach ($meals as $meal) { 
				$sql = "insert into meal_detail(meal_id,product_id) values ('$meal','$id')";
				execute($sql);
			} 
		}

		$menus = (isset($_POST['menu'])) ? $_POST['menu'] : array();

		if (count($menus) > 0) {
			foreach ($menus as $menu) { 
				$sql = "insert into menu_detail(menu_id,product_id) values ('$menu','$id')";
				execute($sql);
			} 
		}

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