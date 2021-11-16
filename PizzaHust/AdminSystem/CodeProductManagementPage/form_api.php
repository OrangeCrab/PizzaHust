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
	$sql = "delete from product where id = $id ";
	//$sql = "update product set deleted = 1, updated_at = '$updated_at' where id = $id";
	execute($sql);
}