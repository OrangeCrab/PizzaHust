<?php
require_once('../../database/utility.php');
require_once('../../database/dbhelper.php');


if(!empty($_POST)) {
	$action = getPost('action');

	switch ($action) {
		case 'delete':
			deleteProduct();
			break;
	}
}

function deleteProduct() {
	$id = getPost('id');
	$sql = "delete from meal_detail where product_id = "."'".$id."'";
	execute($sql);
	$sql = "delete from menu_detail where product_id = "."'".$id."'";
	execute($sql);
	$sql = "delete from product where id = $id ";

	$query = "SELECT * FROM product WHERE id = $id";
	//$get_title = getArrResult($query)['title'];
	$get_image = getArrResult($query)['image'];
	$dir = "../../masterial/image/thuc_don";
	unlink($dir.'/'.$get_image);
	
	execute($sql);
}