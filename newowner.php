<?php  
    $insert = FALSE;
    if(isset($_POST['fname'])){
	$con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $mobno=$_POST['mno'];
    $date=$_POST['dob'];
    $add=$_POST['address'];
    $pass=$_POST['pass'];
	$sql="INSERT INTO `owner` (`fname`,`lname`,`mobile_no`,`No_of_vehicles`,`D.O.B`,`Address`,`Password`) VALUES ('$fname','$lname','$mobno',0,'$date','$add','$pass');";
	if($con->query($sql) == TRUE){
        $insert = TRUE;
    }
	else {
		echo ("Error : $sql <br> $con->error");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>New Owner Registration</title>
</head>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="owner.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue">New Owner Registration Page</font></p></h2>
<br>
<?php
if($insert==TRUE){
    echo "<p class='invalid'>Record Uploaded</p>";
}
?>
<br>
<form action="newowner.php" method="post" align="center">
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
      <input type="text" placeholder="Enter Address" name="address" required>
      <br>
      <br>
      <label><b> Password</b></label>
      <input type="password" placeholder="Enter Password" name="pass" required>
      <br>
      <br>
      <button type="submit" class="submitbtn" name="submit">Submit</button>
    </div>
</form>
</body>
</html>