<?php  
    $insert = FALSE;
    if(isset($_POST['fname'])){
	$con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
    $fname=$_POST['fname'];
    $add=$_POST['address'];
    $pass=$_POST['pass'];
	$sql="INSERT INTO `rto` (`R_name`,`R_loc`,`Password`) VALUES ('$fname','$add','$pass');";
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
    <title>New RTO Registration</title>
</head>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="judiciary.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue">New RTO Registration Page</font></p></h2>
<br>
<?php
if($insert==TRUE){
    echo "<p class='invalid'>Record Uploaded</p>";
}
?>
<br>
<form action="rto.php" method="post" align="center">
    <div class="container">
      <label><b> RTO Name</b></label>
      <input type="text" placeholder="Enter Name" name="fname" required>
      <br>
      <br>
      <label><b> Location</b></label>
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