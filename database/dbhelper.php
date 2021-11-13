<?php 
require_once('define.php');

// them, sua, xoa 
function execute($sql){
    // mo ket noi
    $conn = mysqli_connect(HOST,USERNAME, PASSWORD,DATABASE);
    mysqli_set_charset($conn,'utf8');

    //querry
    mysqli_query($conn,$sql);


    //dong ket noi
    mysqli_close($conn);
}

// querry lay du lieu ra
function executeResult($sql){
    $data = null;

    // mo ket noi
    $conn = mysqli_connect(HOST,USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn,'utf8');

    //querry
    $resultset = mysqli_query($conn,$sql);
    
    $data = [];
    while(($row = mysqli_fetch_array($resultset,1)) != null){
        $data[] = $row;
        
    }

    //dong ket noi
    mysqli_close($conn);
    return $data;


}

function getArrResult($sql){

    $conn = mysqli_connect(HOST,USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn,'utf8');

    $resultset = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($resultset,1);
    mysqli_close($conn);
    
    return $row;
}

function getNumRows($sql){

    $conn = mysqli_connect(HOST,USERNAME, PASSWORD,DATABASE);
    mysqli_set_charset($conn,'utf8');
    $result= mysqli_query($conn,$sql);
    //$count = mysqli_num_rows($result);
    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $result );
    mysqli_close($conn);
    //return $count;
    return $rowcount;
}