<?php  
    session_start();
    $insert = FALSE;
    $validate = FALSE;
    $valid = FALSE;
    if(isset($_POST['vno'])){
	$con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }
    $vehino=$_POST['vno'];
    $fname=$_POST['cno'];
    $lname=$_POST['ftype'];
    $mobno=$_POST['vtype'];
    $add=$_POST['colour'];
    $uid=$_SESSION['username'];
    $col="select `V_no`,`Chassis_no` from `vehicle`;";
    $result = mysqli_query($con,$col);
    if($result->num_rows > 0){
    while($crow = mysqli_fetch_assoc($result)){
            if(isset($crow['V_no'])){
                $data['uid']=$crow['V_no'];
                $data['c_no']=$crow['Chassis_no'];
                $lno=$data['uid'];
                $c_no=$data['c_no'];
                if($lno==$vehino){
                    $validate = TRUE;
                }
                if($c_no==$fname){
                    $valid = TRUE;
                }
            }
            else {
                echo "No user found";
            }
        }
    }
    if($validate==FALSE && $valid==FALSE){
	$sql="INSERT INTO `vehicle` (`v_no`,`chassis_no`,`f_type`,`v_type`,`r_date`,`colour`,`u_id`) VALUES ('$vehino','$fname','$lname','$mobno',CURDATE(),'$add','$uid');";
	if($con->query($sql) == TRUE){

        $row="UPDATE `owner` SET `No_of_vehicles` = `No_of_vehicles` + 1 WHERE `owner`.`U_Id` = '$uid';";
        mysqli_query($con,$row);
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
    <title>Vehicle Registration</title>
</head>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="ownerhome.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue">Vehicle Registration Page</font></p></h2>
<br>
<?php
if($insert==TRUE){
    echo "<p class='invalid'>Vehicle Registered</p>";
}
if($validate==TRUE){
    echo "<p class='invalid'>Enter Unique Vehicle Number</p>";
}
if($valid==TRUE){
    echo "<p class='invalid'>Enter Unique Chassis Number</p>";
}
?>
<br>
<form action="vehicle.php" method="post" align="center">
    <div class="container">
      <label><b>Vehicle No.</b></label>
      <input type="text" placeholder="Enter Vehicle Number" name="vno" required>
      <br>
      <br>
      <label><b> Chassis No.</b></label>
      <input type="text" placeholder="Enter Chassis Number" name="cno" required>
      <br>
      <br>
      <label><b> Vehicle Colour</b></label>
      <input type="text" placeholder="Enter Colour" name="colour" required>
      <br>
      <br>
      <label><b> Fuel Type</b></label>
      <select name="ftype" required>
        <option value="petrol">Petrol</option>
        <option value="diesel">Diesel</option>
        <option value="cng">CNG</option>
      </select>
      <br>
      <br>
      <label><b> Vehicle Type</b></label>
      <select name="vtype" required>
        <option value="two wheeler">Two Wheeler</option>
        <option value="four wheeler">Four Wheeler</option>
      </select>
      <br>
      <br>
      <button type="submit" class="submitbtn" name="submit">Submit</button>
    </div>
</form>
</body>
</html>