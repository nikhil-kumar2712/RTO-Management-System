<?php
    session_start();
    $check = FALSE;
    $insert = FALSE;
    $con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
    $uid=$_SESSION['username'];
	$sql="select * from `license` where `u_id` = '$uid';";
    $result = mysqli_query($con,$sql);
    if($result->num_rows > 0){
    while($row = mysqli_fetch_assoc($result)){
        if(isset($row['u_id'])){
            $data['lno']=$row['L_no'];
            $data['ltype']=$row['L_type'];
            $data['date']=$row['Validity'];
            $data['point']=$row['points'];
            if($data['point']<7){
                $col="DELETE FROM `license` WHERE `u_id`='$uid';";
                if($con->query($col) == TRUE){
                $insert = TRUE;
                }
                else {
                echo ("Error : $col <br> $con->error");
                }
            }
        }
        else {
            echo "No user found";
        }
    }
    }
    else{
        $check = TRUE;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>License Info</title>
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
<h2><p align="center"><font face="Arial Black" color="blue">License Details</font></p></h2>
<br>
<?php
if($check==TRUE){
    echo "<p class='invalid'>License Not Issued</p>";
}
if($insert==TRUE){
    echo "<p class='invalid'>License Cancelled due to Low Points</p>";
}
?>
<br>
<div class="table">
<br>
<label><b> License Number : </b></label>
<?php
if(isset($data['lno'])){
echo $data['lno'];
}
else{
    echo "No data";
}
?>
</div> 
<div class="table">
<br>
<label><b> License Type : </b></label>
<?php
if(isset($data['ltype'])){
echo $data['ltype'];
}
else{
    echo "No data";
}
?>
</div> 
<div class="table">
<br>
<label><b> Valid Upto : </b></label>
<?php
if(isset($data['date'])){
echo $data['date'];
}
else{
    echo "No data";
}
?>
</div>
<div class="table">
<br>
<label><b> Points : </b></label>
<?php
if(isset($data['point'])){
echo $data['point'];
}
else{
    echo "No data";
}
?>
</div>     
</body>
</html>