<?php
include('../../database/define.php');
include('../../database/dbhelper.php');

$input = filter_input_array(INPUT_POST);
 
if ($input['action'] == 'edit') 
{   
    $sql = 'UPDATE plinth SET name = '.$input['name'].', price= '.$input['price'].' WHERE id= '.$input['id'].'';
    execute($sql);
    header('location: plinth.php');
}
// $connect=mysqli_connect('localhost', 'root', '', 'quan_ly_cua_hang_pizza_hust');
// $input = filter_input_array(INPUT_POST);
// $name = mysqli_real_escape_string($connect, $input["name"]);
// $price = mysqli_real_escape_string($connect, $input["price"]); 

// if ($input['action'] == 'edit') 
// {   
//     $sql = "UPDATE plinth SET name ='.$name.', price='$price'  WHERE id='" . $input['id'] . "'";  
//     mysqli_query($connect,$sql);
//     header('location: inline-table-edit.php');
// } 
// if ($input['action'] == 'delete') 
// {
//     mysqli_query($connect,"DELETE FROM plinth   WHERE id='" . $input['id'] . "'");
//     header('location: inline-table-edit.php');
// } 

// mysqli_close($mysqli);

// echo json_encode($input);
?>
