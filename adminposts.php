<?php
	
	session_start();
	define('DB_SERVER', '127.0.0.1');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'bloguser');
	$db = @mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die(mysqli_error());
	/*$row="";
	$sql = "SELECT username FROM members WHERE username = '" . $_SESSION['user_session'] . "'";
	$result = mysqli_query($db,$sql);
	$row = mysql_fetch_array($result,MYSQLI_ASSOC);*/
	if(!(isset($_SESSION['user_session']))){
	//mysqli_close($connection); // Closing Connection
	header('Location: loginreg.php'); // Redirecting To Home Page
	}
	$uname=$_SESSION['user_session'];

	$result=mysqli_query($db,"SELECT * FROM post_table WHERE pauthor='$uname' order by pid desc" );
	
?>

<style type="text/css">
	table, th, td {
    border: 1px solid black;
}
</style>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

		<aside style="float:right;position:relative;margin-left:0.2%;border:0.5px solid #ababab;"><a href="logout.php">Logout</a></aside>
		<aside style="float:right;position:relative;margin-left:0.6%;border:0.5px solid #ababab;"><a href="profile.php">Profile</a></aside>
		<aside style="float:right;position:relative;margin-left:0.8%;border:0.5px solid #ababab;"><a href="editprofile.php">Edit Profile</a></aside>
		<aside style="float:right;position:relative;margin-left:0.10%;border:0.5px solid #ababab;"><a href="adminposts.php">Your Posts</a></aside>
		<aside style="float:right;position:relative;margin-left:0.12%;border:0.5px solid #ababab;"><a href="post.php">Post Something</a></aside>
		<aside style="float:right;position:relative;margin-left:0.14%;border:0.5px solid #ababab;"><a href="home.php">Home</a></aside>
		<aside style="float:right;position:relative;margin-left:0.16%;border:0.5px solid #ababab;"><a href="home.php">Post Index</a></aside>
		<aside style="float:right;position:relative;margin-left:0.18%;border:0.5px solid #ababab;"><a href="editpost.php">Edit Post</a></aside>
		
		<h2 style="margin-left: 44%;"><?php echo "Welcome," ." " . $_SESSION['user_session']; ?></h2>
		<h2 style="text-align:center;">Your Posts</h2>
		<div style="margin-left:40%;margin-top:5%;">
		<table>
		<tr><td>Title</td><td>Category</td><td>Time</td></tr>
		<?php 
			
			while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
				/*echo "<td>".$row['ptitle']."</td><td>".$row['pcategory']."</td>"."<td>".$row['pdatetime']."</td><br>";*/
				echo "<tr><td>" . $row['ptitle'] . "</td><td>" . $row['pcategory'] . "</td><td>" . $row['pdatetime'] . "</td><tr>";
			}
		?>
		</table>
		</div>
		
</body>
</html>