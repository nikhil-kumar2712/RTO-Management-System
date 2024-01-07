<?php  
    session_start();
    $insert = FALSE;
    $check = FALSE;
    if(isset($_POST['fname'])){
	$con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $mobno=$_POST['mno'];
    $date=$_POST['dob'];
    $add=$_POST['add'];
    $uid=$_SESSION['username'];
    $row="select `Fname` from `owner` where `U_Id`='$uid';";
    $result = mysqli_query($con,$row);
    if($result->num_rows > 0){
	$sql="UPDATE `owner` SET `Fname` = '$fname', `Lname` = '$lname', `Mobile_no` = '$mobno', `D.O.B` = '$date', `Address` = '$add' WHERE `owner`.`U_Id` = '$uid';";
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
    <title>Owner Update</title>
</head>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="ownerhome.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue">Owner Info Updation Page</font></p></h2>
<br>
<p class="invalid"> <strong>Enter the details you donot want to update same as before. </strong></p>
<br>
<?php
if($insert==TRUE){
    echo "<p class='invalid'>Owner Info Updated</p>";
}
if($check==TRUE){
    echo "<p class='invalid'>Owner Not Found</p>";
}
?>
<br>
<form action="updateowner.php" method="post" align="center">
    <div class="container">
    <label><b> First Name</b></label>
      <input type="text" placeholder="Enter Name" name="fname" required>
      <br>
      <br>
      <label><b> Last Name</b></label>
      <input type="text" placeholder="Enter Name" name="lname" required>
      <br>
      <br>
      <label><b> Mobile No.</b></label>
      <input type="text" placeholder="Enter Mobile No." name="mno" required>
      <br>
      <br>
      <label><b> Date Of Birth</b></label>
      <input type="date" placeholder="Enter D.O.B" name="dob" required>
      <br>
      <br>
      <label><b> Address</b></label>
      <input type="text" placeholder="Enter Address" name="add" required>
      <br>
      <br>
      <button type="submit" class="submitbtn" name="submit">Submit</button>
    </div>
</form>
</body>
</html>