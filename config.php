<?php
$conn=mysqli_connect('localhost','root','root','task1'); 

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}else{
     //echo "Connected successfully";
}
?>