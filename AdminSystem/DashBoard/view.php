<?php
require_once('../../database/dbhelper.php');

//So don hang
function number_orders(){
    $sql = "SELECT count(*) as `count` from  `order` ";
    $conn = mysqli_connect(HOST,USERNAME, PASSWORD,DATABASE);
    mysqli_set_charset($conn,'utf8');
 
    //querry
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $count = $row['count'];

    //dong ket noi
    mysqli_close($conn);
    return $count;
    
}
//So don hang
function number_users(){
    $sql = "SELECT count(*) as `count` from  `user` ";
    $conn = mysqli_connect(HOST,USERNAME, PASSWORD,DATABASE);
    mysqli_set_charset($conn,'utf8');
 
    //querry
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $count = $row['count'];

    //dong ket noi
    mysqli_close($conn);
    return $count;
}
//So don hang
function number_products(){
    $sql = "SELECT count(*) as `count` from  `product` ";
    $conn = mysqli_connect(HOST,USERNAME, PASSWORD,DATABASE);
    mysqli_set_charset($conn,'utf8');
 
    //querry
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $count = $row['count'];

    //dong ket noi
    mysqli_close($conn);
    return $count;
}


// Hàm lấy 10 đơn mới nhất
function get_overview(){
    $sql = "SELECT  id,payment,userPhoneNumber,userAddress,orderTime,status FROM `order` order by orderTime DESC LIMIT 10";
    return executeResult($sql);
}


//lay 5 pizza order nhieu trong tuan
function get_order_top(){
    $sql = "SELECT productID,`product`.`productName` ,SUM(quatity)
    FROM `orderdetail`,`product`,`order` 
    WHERE productID = `product`.`id` AND orderID=`order`.`id` 
    AND ( `order`.`orderTime` > CURRENT_DATE -7 ) 
    
    GROUP BY productID ORDER BY SUM(quatity) DESC  LIMIT 5";
    return executeResult($sql);
}

//trạng thái hàng
function status_css($status)
{
    if($status ==0) echo "delivered" ;
    else if($status ==1 )echo"return" ;
    else if($status ==2) echo"inprogress" ;
    else if($status ==3) echo"pending" ;
}