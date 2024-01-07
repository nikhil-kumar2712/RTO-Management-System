<?php  
    session_start();
    $insert = FALSE;
    $check = FALSE;
    if(isset($_POST['vno'])){
	$con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }
    $vehino=$_POST['vno'];
    $fname=$_POST['cno'];
    $lname=$_POST['ftype'];
    $mobno=$_POST['vtype'];
    $date=$_POST['rdate'];
    $add=$_POST['colour'];
    $uid=$_SESSION['username'];
    $row="select `V_type` from `vehicle` where `V_no` = '$vehino' and `u_id`='$uid';";
    $result = mysqli_query($con,$row);
    if($result->num_rows > 0){
	$sql="UPDATE `vehicle` SET `Chassis_no` = '$fname', `F_type` = '$lname', `V_type` = '$mobno', `R_date` = '$date', `Colour` = '$add' WHERE `vehicle`.`u_id` = '$uid' AND `vehicle`.`V_no` = '$vehino';";
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
    <title>Vehicle Update</title>
</head>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="ownerhome.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue"> Vehicle Updation Page</font></p></h2>
<br>
<p class="invalid"> <strong>Enter the vehicle no you want to change and enter the other details you donot want to update same as before. </strong></p>
<br>
<?php
if($insert==TRUE){
    echo "<p class='invalid'>Vehicle Updated</p>";
}
if($check==TRUE){
    echo "<p class='invalid'>Vehicle Number Not Found</p>";
}
?>
<br>
<form action="updatevehicle.php" method="post" align="center">
    <div class="container">
      <label><b>Vehicle No.</b></label>
      <input type="text" placeholder="Enter Vehicle Number " name="vno" required>
      <br>
      <br>
      <label><b> Chassis No.</b></label>
      <input type="text" placeholder="Enter Chassis Number" name="cno" required>
      <br>
      <br>
      <label><b> Registraion Date</b></label>
      <input type="date" placeholder=" Enter Registraion Date" name="rdate" required>
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