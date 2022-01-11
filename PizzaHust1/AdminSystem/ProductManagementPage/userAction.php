<?php
//load and initialize database class
require_once 'DB.class.php';
$db = new DB();

$tblName = 'plinth';

if(($_POST['action'] == 'edit') && !empty($_POST['id'])){
    //update data
    $userData = array(
        'name' => $_POST['name'],
        'price' => $_POST['price'],
    );
    $condition = array('id' => $_POST['id']);
    $update = $db->update($tblName, $userData, $condition);
    if($update){
        $returnData = array(
            'status' => 'ok',
            'msg' => 'User data has been updated successfully.',
            'data' => $userData
        );
    }else{
        $returnData = array(
            'status' => 'error',
            'msg' => 'Some problem occurred, please try again.',
            'data' => ''
        );
    }
    
    echo json_encode($returnData);
}elseif(($_POST['action'] == 'delete') && !empty($_POST['id'])){
    //delete data
    $condition = array('id' => $_POST['id']);
    $delete = $db->delete($tblName, $condition);
    if($delete){
        $returnData = array(
            'status' => 'ok',
            'msg' => 'User data has been deleted successfully.'
        );
    }else{
        $returnData = array(
            'status' => 'error',
            'msg' => 'Some problem occurred, please try again.'
        );
    }
    
    echo json_encode($returnData);
}
die();
?>