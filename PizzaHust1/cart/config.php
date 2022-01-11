<?php
$mysqli = new mysqli("localhost","root","","dcm3");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Kết nối bị lỗi: " . $mysqli -> connect_error;
  exit();
}
?>