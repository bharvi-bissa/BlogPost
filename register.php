<?php 

	$msg = "";
	/*define('DB_SERVER', '127.0.0.1');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'bloguser');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die(mysqli_error());

	$msg = '';
	$sample = '';

	if(isset($_POST["username"]))
	{

		$username=$_POST['username'];
		$firstname = $_POST['fname'];
		$lastname = $_POST['lname'];
		$email = $_POST['email'];
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];
	
		$username = mysqli_real_escape_string($db, $username);
		$firstname = mysqli_real_escape_string($db, $firstname);
		$lastname = mysqli_real_escape_string($db, $lastname);
		$email = mysqli_real_escape_string($db, $email);
		$password = md5($pass1);

				


		$sql="SELECT email FROM members WHERE email='$email'";
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

		if(mysqli_num_rows($result) == 1)
		{
			$msg = "Sorry...This email already exist...";
		}

		else
		{
			$query = mysqli_query($db, "INSERT INTO members (username, firstname, lastname,email,password) VALUES ('$username', '$firstname', '$lastname','$email','$password')");
			if($query)
			{
				$msg = "Thank You! you are now registered.";
			}
		}
	}*/ ?>
<!DOCTYPE html>
<html lang="en" style="background:#ccd9ff;">
<head>
	<title>Register</title>
	
	
</head>
		
<body>
	<h1 style="text-align:center;">Register</h1>
	<p style="text-align:center;"><?php echo $msg; ?></p>
	
		<form method="post" style="text-align:center;" id="regForm">
		<input type="text" name="username" placeholder="Username" style="height:20px;border:1px solid;" id="username"></br>
		<input type="text" name="fname" placeholder="Firstname" style="height:20px;border:1px solid;" id="firstname"></br>
		<input type="text" name="lname" placeholder="Lastname" style="height:20px;border:1px solid;" id="lastname"></br>
		<input type="text" name="email" placeholder="Email Address" style="height:20px;border:1px solid;" id="email"></br>
		<input type="password" name="pass1" placeholder="Password" style="height:20px;border:1px solid;"  id="pass1"></br>
		<input type="password" name="pass2" placeholder="Confirm Password" style="height:20px;border:1px solid;" id="pass2"></br> 
		<input type="submit"  value="Register" style="height:20px;border:1px solid;" id="submit">
	</form>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			$('#regForm').submit(function(event) {
				event.preventDefault();
				var username =document.getElementById('username').value;
				var fname =document.getElementById('firstname').value;
				var lname =document.getElementById('lastname').value;
				var email =document.getElementById('email').value;
				var pass =document.getElementById('pass1').value;
				$.ajax({
					type : 'POST',
					url : 'ajax.php',
					data : {
						username : username,
						fname : fname,
						lname : lname,
						email : email,
						pass : pass
					},
					cache : false,
					success : function(data) {
						alert(data);
						console.log(data);
					}
				});
			});
		});
	</script>

</body>
</html>
