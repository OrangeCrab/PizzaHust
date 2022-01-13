<?php
    require_once('../../database/utility.php');
    require_once('../../database/dbhelper.php');

    if (($_POST['action'] == 'delete_product') && !empty($_POST['id'])) {
        $id = getPost('id');
        deleteProduct($id);
    }

    function deleteProduct($id) {
        $sql = "delete from product where id = $id ";
        $query = "SELECT * FROM product WHERE id = $id";
        $get_image = getArrResult($query)['image'];
        $dir = "../../masterial/image/thuc_don";
        unlink($dir.'/'.$get_image);
        execute($sql);
        $returnData = array(
            'status' => 'ok'    
        );
        echo json_encode($returnData);
    }

    if ($_POST['action'] == 'add_pb') {
        $name = getPost('name');
        $price = getPost('price');
        $sql = "INSERT INTO plinth(name, price) VALUES ('$name', '$price')";
	    execute($sql);
        $returnData = array(
            'status' => 'ok'
        );
        echo json_encode($returnData);
    }

    if (($_POST['action'] == 'edit') && !empty($_POST['id'])) {
        $id = getPost('id');
        $name = getPost('name');
        $price = getPost('price');
        editPizzaBase($id, $name, $price);
    }

    function editPizzaBase($id, $name, $price){
        $query = "update plinth set name = '$name', price = '$price' where id = $id";
        execute($query);
        $returnData = array(
            'status' => 'ok',
            'name' => $name,
            'price' => $price    
        );
        echo json_encode($returnData);
    }

    if (($_POST['action'] == 'delete_pb') && !empty($_POST['id'])) {
        $id = getPost('id');
        deletePizzaBase($id);
    }

    function deletePizzaBase($id) {
        $sql = "delete from plinth where id = $id ";
        execute($sql);
        $returnData = array(
            'status' => 'ok'    
        );
        echo json_encode($returnData);
    }
?>