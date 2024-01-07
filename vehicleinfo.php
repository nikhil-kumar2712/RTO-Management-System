<?php
    session_start();
    $check=FALSE;
    $con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
    $uid=$_SESSION['username'];
	$sql="select * from `vehicle` where `u_id` = '$uid';";
    $result = mysqli_query($con,$sql);
    if($result->num_rows > 0){
        $check=FALSE;
    }
    else{
        $check=TRUE; 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Vehicle Info</title>
</head>
<style>
    .image {
        opacity: 0.5;
    }
</style>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="ownerhome.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue">Vehicle Details</font></p></h2>
<br>
<?php
if($check==TRUE){
    echo "<p class='invalid'>No Vehicle Registered</p>";
}
?>
<br>
<table>
<tr>
    <td><strong> Vehicle No. </strong></td>
    <td><strong> Chassis No. </strong></td>
    <td><strong> Fuel Type </strong></td>
    <td><strong> Vehicle Type </strong></td>
    <td><strong> Registraion Date </strong></td>
    <td><strong> Colour </strong></td>
</tr>
<?php
while($row = mysqli_fetch_assoc($result)){
?>
<tr>
    <td><?php if(isset($row['V_no'])){echo $row['V_no'];} ?></td>
    <td><?php if(isset($row['Chassis_no'])){echo $row['Chassis_no'];} ?></td>
    <td><?php if(isset($row['F_type'])){echo $row['F_type'];} ?></td>
    <td><?php if(isset($row['V_type'])){echo $row['V_type'];} ?></td>
    <td><?php if(isset($row['R_date'])){echo $row['R_date'];} ?></td>
    <td><?php if(isset($row['Colour'])){echo $row['Colour'];} ?></td>
</tr>
<?php
}
?>
</table>   
</body>
</html>