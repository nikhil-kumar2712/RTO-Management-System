<?php
    session_start();
    $check=FALSE;
    $con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
    $uid=$_SESSION['rtoname'];
	$sql="SELECT `C_no`,`C_details`,`Fine`,`C_date`,`t_id`,`v_no`,`uid` FROM `challan`,`rto` WHERE `challan`.`Location`=`rto`.`R_loc` AND `rto`.`R_Id`= '$uid';";
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
    <title>All Challan Info</title>
</head>
<style>
    .image {
        opacity: 0.5;
    }
</style>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="rtohome.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue">All Challan Details</font></p></h2>
<br>
<?php
if($check==TRUE){
    echo "<p class='invalid'>No Challan Issued</p>";
}
?>
<br>
<table>
<tr>
    <td><strong> Challan No. </strong></td>
    <td><strong> Challan Details </strong></td>
    <td><strong> Fine </strong></td>
    <td><strong> Challan Date </strong></td>
    <td><strong> Traffic Inspector Id </strong></td>
    <td><strong> Owner Id </strong></td>
</tr>
<?php
while($row = mysqli_fetch_assoc($result)){
?>
<tr>
    <td><?php if(isset($row['C_no'])){echo $row['C_no'];} ?></td>
    <td><?php if(isset($row['C_details'])){echo $row['C_details'];} ?></td>
    <td><?php if(isset($row['Fine'])){echo $row['Fine'];} ?></td>
    <td><?php if(isset($row['C_date'])){echo $row['C_date'];} ?></td>
    <td><?php if(isset($row['t_id'])){echo $row['t_id'];} ?></td>
    <td><?php if(isset($row['uid'])){echo $row['uid'];} ?></td>
</tr>
<?php
}
?>
</table>   
</body>
</html>