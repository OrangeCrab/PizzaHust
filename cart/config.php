<?php
$mysqli = new mysqli("localhost","root","","quan_ly_cua_hang_pizza_hust");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Kết nối bị lỗi: " . $mysqli -> connect_error;
  exit();
}
?>