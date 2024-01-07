<?php    
    session_start();
    $insert = FALSE;
    $check = FALSE;
    if(isset($_POST['username'])){
	$con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
    $uid=$_POST['username'];
    $pass=$_POST['password'];
	$sql="SELECT `fname` FROM `owner` WHERE `U_Id`='$uid' AND `Password`='$pass';";
	$result = $con->query($sql);
	$row2=mysqli_fetch_row($result);
	if(mysqli_num_rows($result) > 0){
        $_SESSION['username'] = $uid;
        header("Location: ownerhome.html");
        die();
    }
    else{
        $check = TRUE;
    }
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
    <title>Registered Owner Login</title>
</head>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="owner.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue">Owner Login Page</font></p></h2>
<br>
<br>
<form action="ownerlogin.php" method="post" align="center">
    <div class="container">
      <label><b>User ID</b></label>
      <input type="number" placeholder="Enter User Id" name="username" required>
      <br>
      <label><b> Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
      <br>
      <?php
       if($check==TRUE){
       echo "<p class='invalid'>Invalid Credentials</p>";
       }
       ?>
      <br>
      <button type="submit" class="submitbtn" name="submit">Submit</button>
    </div>
</form>
</body>
</html>