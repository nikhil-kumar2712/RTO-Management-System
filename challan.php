<?php  
    session_start();
    $insert = FALSE;
    $check = FALSE;
    $valid = FALSE;
    $validity = FALSE;
    $flag = 2; 
    if(isset($_POST['vno'])){
	$con = mysqli_connect("localhost","root","","rto_management");
	if (!$con){
        die("Failed to connect to MySQL: " . mysqli_connect_error());
	}
    $tid=$_SESSION['inspectorid'];
    $cd=$_POST['detail'];
    $v_no=$_POST['vno'];
    $loca=$_POST['loc'];
    $row="select `u_id` from `vehicle` where `V_no` = '$v_no';";
    $result = mysqli_query($con,$row);
    if($result->num_rows > 0){
    while($row = mysqli_fetch_assoc($result)){
        if(isset($row['u_id'])){
            $data['uid']=$row['u_id'];
            $uid=$data['uid'];
            $row3="select `u_id` from `license`;";
            $result1 = mysqli_query($con,$row3);
            if($result1->num_rows > 0){
            while($row3 = mysqli_fetch_assoc($result1)){
            if(isset($row3['u_id'])){
                $data['lid']=$row3['u_id'];
                $lid=$data['lid'];
                if($lid==$uid){
                    $flag = 0;
                    break;
                }
                else{
                    $flag = 1;
                }
            }
            }
            }
            if($flag == 0){
                $validity = TRUE;
            }
            else if($flag == 1){
                $valid = TRUE;
                $sql="INSERT INTO `challan` (`C_details`,`Fine`,`C_date`,`t_id`,`v_no`,`uid`,`Location`) VALUES ('License Not Found',5000,CURDATE(),'$tid','$v_no','$uid','$loca');";
                if($con->query($sql) == TRUE){
                $insert = TRUE;
                $row4="UPDATE `license` SET `points` = `points`-5 WHERE `u_id` = '$uid';";
                $con->query($row4);
                }
            }
        }
    }
    if($cd=='Not Wearing Helmet'){
        $fine=500;
    }
    else if($cd=='Overspeeding'){
        $fine=1000;
    }
    else if($cd=='Accident'){
        $fine=2000;
    }
	$sql="INSERT INTO `challan` (`C_details`,`Fine`,`C_date`,`t_id`,`v_no`,`uid`,`Location`) VALUES ('$cd','$fine',CURDATE(),'$tid','$v_no','$uid','$loca');";
	if($con->query($sql) == TRUE){
        $insert = TRUE;
        if($cd=='Not Wearing Helmet'){
            $row1="UPDATE `license` SET `points` = `points`-1 WHERE `u_id` = '$uid';";
            $con->query($row1);
        }
        else if($cd=='Overspeeding'){
            $row1="UPDATE `license` SET `points` = `points`-2 WHERE `u_id` = '$uid';";
            $con->query($row1);
        }
        else if($cd=='Accident'){
            $row1="UPDATE `license` SET `points` = `points`-3 WHERE `u_id` = '$uid';";
            $con->query($row1);
        }
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
    <title>Generate Challan</title>
</head>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<div class="header">
    <a href="inspectorhome.html">Back</a>
</div>
<h2><p align="center"><font face="Arial Black" color="blue">Genetaring Challan Page</font></p></h2>
<br>
<?php
if($insert==TRUE){
    echo "<p class='invalid'>Challan Generated</p>";
}
if($check==TRUE){
    echo "<p class='invalid'>Vehicle Number Not Found</p>";
}
if($validity==TRUE){
    echo "<p class='invalid'>License Found</p>";
}
if($valid==TRUE){
    echo "<p class='invalid'>License Not Found</p>";
}
?>
<br>
<form action="challan.php" method="post" align="center">
    <div class="container">
      
      <label><b> Vehicle No. </b></label>
      <input type="text" placeholder="Enter Vehicle Number" name="vno" required>
      <br>
      <br>
      <label><b> Challan Details </b></label>
      <select name="detail" required>
        <option value="Not Wearing Helmet">Not Wearing Helmet</option>
        <option value="Overspeeding">Overspeeding</option>
        <option value="Accident">Accident</option>
      </select>
      <br>
      <br>
      <label><b> Location </b></label>
      <select name="loc" required>
        <option value="Karve Nagar">Karve Nagar</option>
        <option value="Kothrud">Kothrud</option>
        <option value="Baner">Baner</option>
        <option value="Deccan">Deccan</option>
        <option value="FC Road">FC Road</option>
        <option value="Koregaon Park">Koregaon Park</option>
      </select>
      <br>
      <br>
      <button type="submit" class="submitbtn" name="submit">Submit</button>
    </div>
</form>
</body>
</html>