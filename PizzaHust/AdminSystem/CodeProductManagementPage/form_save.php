<?php

if(!empty($_POST)) {
	$productImg = setImgAndGetImgID();
	$id = getPost('id');
	$productName = getPost('productName');
	$productPrice = getPost('productPrice');

    $statusID = getPost('statusID');
    $date = getPost('date');
	$description = getPost('description');
	$categoryID = getPost('categoryID');

	if($id > 0) {
		if($productImg != '') {
			$sql = "update product set productImg = '$productImg', productName = '$productName', productPrice = $productPrice, 
			statusID= '$statusID', description = '$description', date = '$date',categoryID = '$categoryID' 
			where id = $id";
		} else {
			$getproductImg = "select productImg from product where id=$id";
			$result = getArrResult($getproductImg);
			$getproductImg = $result['productImg'];
			$sql = "update product set productImg = '$getproductImg', productName = '$productName', productPrice = $productPrice, statusID = $statusID, 
			description = '$description', date = '$date', categoryID = '$categoryID' where id = $id";
		}
		
		execute($sql);
		header('location: ProductManagementPage.php');
		die();
	} else {
		//insert
		$sql = "insert into product(productImg, productName, productPrice, statusID, description, categoryID) values ('$productImg', '$productName', '$productPrice', '$statusID', '$description', '$categoryID')";
		execute($sql);

		header('location: ProductManagementPage.php');
		die();
	}
}

function setImgAndGetImgID()
{
	if (isset($_POST['confirm'])) {
		$productImg = $_FILES['productImg']['name'];
		return $productImg;
	}
}