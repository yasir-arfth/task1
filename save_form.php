<?php
include("config.php");

$name=$_POST['name'];
$surname=$_POST['surname'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$address=$_POST['address'];
$country=$_POST['country'];
$state=$_POST['state'];

echo $sql="INSERT INTO `form_data`(`name`, `surname`, `phone`, `email`, `address`, `country`, `state`) VALUES ('$name','$surname','$phone','$email','$address','$country','$state')";

    if(mysqli_query($conn,$sql))
{
    echo("successfully added to database");
}
else{
    echo("not able to add in database");
}


mysqli_close($conn);

?>