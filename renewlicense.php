<?php  
    session_start();
    $insert = FALSE;
    $check = FALSE;
    if(isset($_POST['lno'])){
	$con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }
    $uid=$_SESSION['username'];
    $l_no=$_POST['lno'];
    $sql="select `Validity` from `license` where `L_no` = '$l_no';";
    $result = mysqli_query($con,$sql);
    if($result->num_rows > 0){
    while($row = mysqli_fetch_assoc($result)){
        if(isset($row['Validity'])){
            $data['date']=$row['Validity'];
            $val=$data['date'];
        }
        else {
            echo "No user found";
        }
    }
	$abc="UPDATE `license` SET `Validity` = '$val' + INTERVAL 5 YEAR WHERE `license`.`u_id` = '$uid' AND `license`.`L_no` = '$l_no';";
	if($con->query($abc) == TRUE){
        $insert = TRUE;
    }
	else {
		echo ("Error : $abc <br> $con->error");
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
    <title>License Renewal</title>
</head>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="ownerhome.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue">License Renewal Information Page</font></p></h2>
<br>
<?php
if($insert==TRUE){
    echo "<p class='invalid'>License Renewed</p>";
}
if($check==TRUE){
    echo "<p class='invalid'>License Number Not Found</p>";
}
?>
<br>
<form action="renewlicense.php" method="post" align="center">
    <div class="container">
      <label><b>License No.</b></label>
      <input type="text" placeholder="Enter License Number " name="lno" required>
      <br>
      <br>
      <button type="submit" class="submitbtn" name="submit">Submit</button>
    </div>
</form>
</body>
</html>