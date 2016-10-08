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
	//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	if(!(isset($_SESSION['user_session']))){
	//mysqli_close($connection); // Closing Connection
	header('Location: loginreg.php'); // Redirecting To Home Page
	}

?>
<!DOCTYPE html>
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
		<aside style="float:right;position:relative;margin-left:0.16%;border:0.5px solid #ababab;"><a href="index.php">Post Index</a></aside>
		<aside style="float:right;position:relative;margin-left:0.18%;border:0.5px solid #ababab;"><a href="editpost.php">Edit Post</a></aside>
		<h2 style="margin-left: 45%;"><?php echo "Welcome," ." " . $_SESSION['user_session']; ?></h2>

		<div>
		
		<h3 style="font-size:30px; text-align:center;">Members Area !</h3>
		
	</div>
</body>

