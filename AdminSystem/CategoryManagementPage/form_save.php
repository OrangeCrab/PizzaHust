<?php
if(!empty($_POST)) {
	$id = getPost("id");
	$name = getPost("name");

	if($id > 0) {
		//update
		$sql = "update Category set name = '$name' where id = $id";
		execute($sql);
	} else {
		//insert
		$sql = "insert into Category(name) values ('$name')";
		execute($sql);
	}
}