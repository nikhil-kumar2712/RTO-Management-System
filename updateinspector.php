<?php  
    session_start();
    $insert = FALSE;
    $check = FALSE;
    if(isset($_POST['tname'])){
	$con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }
    $fname=$_POST['tname'];
    $lname=$_POST['des'];
    $uid=$_SESSION['inspectorid'];
    $row="select `T_name` from `traffic` where `T_Id`='$uid';";
    $result = mysqli_query($con,$row);
    if($result->num_rows > 0){
	$sql="UPDATE `traffic` SET `T_name` = '$fname', `Designation` = '$lname' WHERE `traffic`.`T_Id` = '$uid';";
	if($con->query($sql) == TRUE){
        $insert = TRUE;
    }
	else {
		echo ("Error : $sql <br> $con->error");
	}
    }
    else{
        $check = TRUE;
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Traffic Police Update</title>
</head>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="inspectorhome.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue">Owner Info Updation Page</font></p></h2>
<br>
<p class="invalid"> <strong>Enter the details you donot want to update same as before. </strong></p>
<br>
<?php
if($insert==TRUE){
    echo "<p class='invalid'>Traffic Police Info Updated</p>";
}
if($check==TRUE){
    echo "<p class='invalid'>Traffic Police Not Found</p>";
}
?>
<br>
<form action="updateinspector.php" method="post" align="center">
    <div class="container">
    <label><b> Full Name</b></label>
      <input type="text" placeholder="Enter Name" name="tname" required>
      <br>
      <br>
      <label><b> Designation</b></label>
      <input type="text" placeholder="Enter Name" name="des" required>
      <br>
      <br>
      <button type="submit" class="submitbtn" name="submit">Submit</button>
    </div>
</form>
</body>
</html>