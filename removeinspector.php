<?php
    $insert = FALSE;
    $validate = FALSE;
    $flag = 2;
    if(isset($_POST['userid'])){
    $con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
    $uid=$_POST['userid'];
    $col="select `T_Id` from `traffic`;";
    $result = mysqli_query($con,$col);
    if($result->num_rows > 0){
    while($crow = mysqli_fetch_assoc($result)){
        if(isset($crow['T_Id'])){
            $data['tid']=$crow['T_Id'];
            $lno=$data['tid'];
            if($lno==$uid){
                $flag = 0;
                break;
            }
            else{
                $flag = 1;
            }
        }
    }
    }
    if($flag==0){
        $validate = FALSE;
    }
    else if($flag==1){
        $validate = TRUE;
    }
    if($validate==FALSE){
	$sql="DELETE FROM `traffic` WHERE `T_Id`='$uid';";
    if($con->query($sql) == TRUE){
        $insert = TRUE;
    }
    else {
        echo ("Error : $sql <br> $con->error");
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
    <title>Remove Police</title>
</head>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="trafficinspectorhome.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue">Traffic Police Removal Page</font></p></h2>
<br>
<p class="invalid"><strong>Enter the Traffic Police Id whom you want to remove.</strong></p>
<br>
<?php
if($insert==TRUE){
    echo "<p class='invalid'>Traffic Police Removed</p>";
}
if($validate==TRUE){
    echo "<p class='invalid'>Traffic Police ID Not Found</p>";
}
?>
<br>
<br>
<form action="removeinspector.php" method="post" align="center">
    <div class="container">
      <label><b> Traffic Police ID</b></label>
      <input type="text" placeholder="Enter ID" name="userid" required>
      <br>
      <br>
      <button type="submit" class="submitbtn" name="submit">Submit</button>
    </div>
</form>
</body>
</html>