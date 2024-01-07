<?php  
    session_start();
    $valid = FALSE;
    $insert = FALSE;
    $validate = FALSE;
    $check = FALSE;
    if(isset($_POST['lno'])){
	$con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
    $uid=$_SESSION['username'];
    $l_no=$_POST['lno'];
    $l_type=$_POST['ltype'];
    $rol="select `L_no` from `license` where `u_id` <> '$uid';";
    $result2 = mysqli_query($con,$rol);
    if($result2->num_rows > 0){
    while($rrow = mysqli_fetch_assoc($result2)){
    if(isset($rrow['L_no'])){
        $data['uid']=$rrow['L_no'];
        $lno=$data['uid'];
        if($lno==$l_no){
            $validate = TRUE;

        }
    }
    }
    }
    if($validate==FALSE){
    if($l_type == "learner"){
	$sql="INSERT INTO `license` (`L_no`,`L_type`,`Validity`,`points`,`u_id`) VALUES ('$l_no','$l_type',CURDATE() + INTERVAL 6 MONTH,25,'$uid');";
    if($con->query($sql) == TRUE){
        $insert = TRUE;
    }
    else {
        echo ("Error : $sql <br> $con->error");
    }
    }
    else{
    $col="select `L_no` from `license` where `u_id`='$uid';";
    $result = mysqli_query($con,$col);
    if($result->num_rows > 0){
        $row="DELETE FROM `license` WHERE `L_no`='$l_no' and `u_id`='$uid';";
        if($con->query($row) == TRUE){
        $sql="INSERT INTO `license` (`L_no`,`L_type`,`Validity`,`points`,`u_id`) VALUES ('$l_no','$l_type',CURDATE() + INTERVAL 20 YEAR,25,'$uid');";
        if($con->query($sql) == TRUE){
            $insert = TRUE;
        }
        else {
            echo ("Error : $sql <br> $con->error");
        }
        }
        $valid=FALSE;
    }
    else{
        $valid=TRUE;
    }
    }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>License Application</title>
</head>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="ownerhome.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue">License Application Page</font></p></h2>
<br>
<p class="invalid"> <strong> If you are applying for license for the first time , apply for learner license then only you can apply for driving license. </strong></p>
<br>
<?php
if($insert==TRUE){
    echo "<p class='invalid'>License Applied</p>";
}
else if($validate==TRUE){
    echo "<p class='invalid'>Enter Unique License Number</p>";
}
else if($valid==TRUE){
    echo "<p class='invalid'>Apply for Learner License First</p>";
}
?>
<br>
<form action="license.php" method="post" align="center">
    <div class="container">
      <label><b> License No.</b></label>
      <input type="text" placeholder="Enter License No." name="lno" required>
      <br>
      <br>
      <label><b> License Type</b></label>
      <select name="ltype" required>
        <option value="learner">Learner's</option>
        <option value="driving">Driving</option>
      </select>
      <br>
      <br>
      <button type="submit" class="submitbtn" name="submit">Submit</button>
    </div>
</form>
</body>
</html>