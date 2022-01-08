<?php
require_once('../../database/utility.php');
require_once('../../database/dbhelper.php');


if(!empty($_POST)) {
	$action = getPost('action');

	switch ($action) {
		case 'delete':
			deleteProduct();
			break;
		case 'edit' : 
			$id = getPost('id');
			// print_r( "id to".$id);
			$sql = "SELECT * from `coupon` where id_cp='$id'";
			echo json_encode(getArrResult($sql));
			break;
	}
}

function deleteProduct() {
	$id = getPost('id');
	$sql = "delete from coupon where id_cp = $id ";
	execute($sql);
}
