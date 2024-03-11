<?php 
include('config.php');
$country = $_POST['country'];
$query="SELECT * FROM `states` WHERE country = '$country'";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result) > 0) {
	?>
	<option value="">Choose State</option>
	<?php
    while($row = mysqli_fetch_array($result)) { 
        ?>
        <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
        <?php 
    }
} else {
    ?>
    <option value="NA">NA</option>
    <?php
}  
?>