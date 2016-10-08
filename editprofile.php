<?php
	session_start();
	$firstname="";
	define('DB_SERVER', '127.0.0.1');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'bloguser');
	$db = @mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die(mysqli_error());
	$row="";
	//selecting full row of members where userame ="Session variable name"
	$sql = "SELECT * FROM members WHERE username = '" . $_SESSION['user_session'] . "'";
	$result = mysqli_query($db,$sql);
	$row=mysqli_fetch_assoc($result);
	//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);



	if(!(isset($_SESSION['user_session']))){
	//mysqli_close($connection); // Closing Connection
	header('Location: loginreg.php'); // Redirecting To Home Page
	} 
?>

<!doctype html>
<html lang="en">
<head>
	<title>Welcome to BlogPost</title>
	
</head>

<body>
	<!--dont name session variable and $variable same-->

		<aside style="float:right;position:relative;margin-left:0.2%;border:0.5px solid #ababab;"><a href="logout.php">Logout</a></aside>
		<aside style="float:right;position:relative;margin-left:0.6%;border:0.5px solid #ababab;"><a href="profile.php">Profile</a></aside>
		<aside style="float:right;position:relative;margin-left:0.8%;border:0.5px solid #ababab;"><a href="editprofile.php">Edit Profile</a></aside>
		<aside style="float:right;position:relative;margin-left:0.10%;border:0.5px solid #ababab;"><a href="adminposts.php">Your Posts</a></aside>
		<aside style="float:right;position:relative;margin-left:0.12%;border:0.5px solid #ababab;"><a href="post.php">Post Something</a></aside>
		<aside style="float:right;position:relative;margin-left:0.14%;border:0.5px solid #ababab;"><a href="home.php">Home</a></aside>
		<aside style="float:right;position:relative;margin-left:0.16%;border:0.5px solid #ababab;"><a href="home.php">Post Index</a></aside>
		<aside style="float:right;position:relative;margin-left:0.18%;border:0.5px solid #ababab;"><a href="editpost.php">Edit Post</a></aside>
		<h2 style="margin-left: 45%;"><?php echo "Welcome," ." " . $_SESSION['user_session']; ?></h2>
	
 
		<div style="margin-left:40%;">
		
		<div><h3>Edit Profile</h3></div>
		
 			<form action="<?php echo $_SERVER['PHP_SELF']?> " method="post">
 				<label>Username </label><input type="text" name="username" value="<?php echo $row['username']; ?>"> <br>
 				
 				<label>First Name:</label> <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>"><br>
 				<label>Last Name</label> <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>"><br>
 				<label>Email</label> <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
 				<input type="submit" name="update" value="update">
 			</form>
 	</div>
</body>


<?php

	if(isset($_POST['username'])){
		$username="";
		/*$password="";*/
		$firstname="";
		$lastname="";
		$email="";
		$uname= $_SESSION['user_session'];

		@$username=$_POST['username'];
		/*@$password=md5($_POST['password']);*/
		@$firstname=$_POST['firstname'];
		@$lastname=$_POST['lastname'];
		@$email=$_POST['email'];



		$username=mysqli_escape_string($db,$username);
		/*$password=mysqli_escape_string($db,$password);*/
		$firstname=mysqli_escape_string($db,$firstname);
		$lastname=mysqli_escape_string($db,$lastname);
		$email=mysqli_escape_string($db,$email);

	if(empty($username) || empty($firstname) || empty($lastname) || empty($email)){
		echo "<script>alert('Please fill all the fields');</script>";
	}

	$query=
	@mysqli_query($db,"UPDATE members SET username='$username', password='$password',firstname='$firstname', lastname='$lastname', email='$email' WHERE username='$uname'");
	


	if($query){
		echo "<script> alert('Profile updated successfully !');</script>";
		
	}
	else{
		echo "<script> alert('Profile not updated !');</script>";
		$username="";
		$password="";
		$firstname="";
		$lastname="";
		$email="";


	}
}


?>


