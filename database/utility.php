<?php
function getGet($key){
    $value = '';
    if(isset($_GET[$key])){
        $value = $_GET[$key];
    }
    return $value;
}

function getPost($key){
    $value = '';
    if(isset($_POST[$key])){
        $value = $_POST[$key];
    }
    return $value;
}