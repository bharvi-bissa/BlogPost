<?php
	
	define('DB_SERVER', '127.0.0.1');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'bloguser');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die(mysqli_error());
	$error="";
	if(isset($_POST['username'])){
		if(empty($_POST["username"]) || empty($_POST["pass1"])){
			$error="Please Fill All The Fields.";
		}
		else{
			$username=$_POST['username'];
			$password=$_POST['pass1'];


			// To protect from MySQL injection
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysqli_real_escape_string($db, $username);
			$password = mysqli_real_escape_string($db, $password);
			$password = md5($password);

			$sql="SELECT id FROM members WHERE username ='$username' and password='$password'";
			$result=mysqli_query($db,$sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

			if(mysqli_num_rows($result) == 1){
				session_start();
				$_SESSION['user_session'] = $username; // Initializing Session
				header("location: home.php"); // Redirecting To Other Page
			}else{
				$error="incorrect username or passoword";
			}	
		}
	
 	}

?>
<!DOCTYPE html>
<html lang="en" style="background:#ccd9ff;">
<head>
	<title>Login</title>
	<div style="border:4px solid #fff;width:200px;height:200px;margin-left:40%;margin-top:5%;">
	<p style="text-align:center;"><?php echo $error; ?></p>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="text-align:center;margin-top:5%;">
		<h2>Login</h2>
		<input type="text" name="username" placeholder="Username" style="height:20px;border:1px solid;"></br>
		<input type="password" name="pass1" placeholder="Password" style="height:20px;border:1px solid;"></br>
		<input type="submit" name="Submit" value="Login " style="height:20px;border:1px solid;">
	</form>
	<div>
</head>

<body>
	
</body>

