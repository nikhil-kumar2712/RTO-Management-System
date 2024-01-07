<?php
    session_start();
    $con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
    $uid=$_SESSION['username'];
	$sql="select * from `owner` where `U_Id` = '$uid';";
    $result = mysqli_query($con,$sql);
    if($result->num_rows > 0){
    while($row = mysqli_fetch_assoc($result)){
        if(isset($row['U_Id'])){
            $data['userid']=$row['U_Id'];
            $data['fname']=$row['Fname'];
            $data['lname']=$row['Lname'];
            $data['mno']=$row['Mobile_no'];
            $data['vno']=$row['No_of_vehicles'];
            $data['dob']=$row['D.O.B'];
            $data['add']=$row['Address'];
        }
        else {
            echo "No user found";
        }
    }
    }
    else{
        echo "0 result";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Owner Information</title>
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
<h2><p align="center"><font face="Arial Black" color="blue">Owner Details</font></p></h2>
<br>
<div class="table">
<br>
<label><b>User ID : </b></label>
<?php
echo $data['userid'];
?>
</div> 
<div class="table">
<br>
<label><b> First Name : </b></label>
<?php
echo $data['fname'];
?>
</div> 
<div class="table">
<br>
<label><b> Last Name : </b></label>
<?php
echo $data['lname'];
?>
</div> 
<div class="table">
<br>
<label><b> Mobile No. : </b></label>
<?php
echo $data['mno'];
?>
</div> 
<div class="table">
<br>
<label><b> No. Of Vehicles : </b></label>
<?php
echo $data['vno'];
?>
</div> 
<div class="table">
<br>
<label><b> Date Of Birth : </b></label>
<?php
echo $data['dob'];
?>
</div> 
<div class="table">
<br>
<label><b> Address : </b></label>
<?php
echo $data['add'];
?>
</div>    
</body>
</html>