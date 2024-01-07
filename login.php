<?php
    $insert = FALSE;
    if( isset($_POST["username"]) || isset($_POST["password"])){
        $user = $_POST["username"];
        $pass = $_POST["password"];
        if($user=="Neikel"&& $pass=="2172"){
            header("Location: home.html");
            die();
        }
        else{
            $insert = TRUE;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="RTO WEB TEMPLATE" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
<img class="image" src="1.jpeg" alt="RTO Office">
<h2><p align="center"><font face="Arial Black" color="blue">RTO Maharastra Admin Login Page</font></p></h2>
<?php
    if($insert==TRUE){
    echo "<p class='invalid'>Invalid Credentials</p>";
    }
    ?>
<form action="" method="post" align="center">
<div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>
	<br>
    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
	<br>
    <br>
    <input type="submit" value="Login"/>
</div>
</form>
</body>
</html>