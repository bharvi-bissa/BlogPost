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
	$msg='';
	

	/*$title=$_POST['posttitle'];
	$category=$_POST['postcategory'];
	$author =  $_SESSION['user_session'];
	$content= $_POST['postcontent'];

		$title = mysqli_real_escape_string($db, $title);
		$category = mysqli_real_escape_string($db, $category);
		$author = mysqli_real_escape_string($db, $author);
		$content = mysqli_real_escape_string($db, $content);


		if(empty($title) || empty($category) || empty($author) || empty($content) ){
			$msg= "please fill all fields";
		}
		else{

		$query = mysqli_query($db, "INSERT INTO post_table (ptitle, pcategory, pauthor,pcontent) VALUES ('$title', '$category', '$author','$content')");
			if($query)
			{
				$msg = "Posted!";
				
			}
		}*/


 ?>

 <style type="text/css">
 	body{
 		background:#fff;
 	}
 	input{
 		border:2px solid #000000;
 	}

 	textarea{
 		border:2px solid #000000;
 	}
 </style>

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
		<aside style="float:right;position:relative;margin-left:0.16%;border:0.5px solid #ababab;"><a href="home.php">Post Index</a></aside>
		<aside style="float:right;position:relative;margin-left:0.18%;border:0.5px solid #ababab;"><a href="editpost.php">Edit Post</a></aside>
		<h4><?php echo $msg; ?></h4>
		<h3 style="    margin-left: 40%;">Want to share something, Post it!</h3>
		<form  style="border:2px solid grey;width:500px;height:500px;padding-left:2%;margin-left:30%;" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> <br><br>
		<div>Post Title:<input type="text" name="posttitle" id="postitle"><br></div><br><br>
		<div>Post Category:<input type="text" name="postcategory" id="postcategory"><br></div><br><br>
		<div>Post:<textarea  rows="4" cols="50" name="postcontent" id="postcontent"></textarea><br></div><br><br>
		<div><input type="submit" name="Post" value="Post"></div>
		
	</form>

	
</body>

<?php
	$title='';
	$category='';
	$msg='';
	$content='';
	
	@$title=$_POST['posttitle'];
	@$category=$_POST['postcategory'];
	@$author =  $_SESSION['user_session'];
	@$content= $_POST['postcontent'];

		$title = mysqli_real_escape_string($db, $title);
		$category = mysqli_real_escape_string($db, $category);
		$author = mysqli_real_escape_string($db, $author);
		$content = mysqli_real_escape_string($db, $content);


		if(empty($title) || empty($category) || empty($content) ){
			$msg= "please fill all fields";
			
		}
		else{

		$query = mysqli_query($db, "INSERT INTO post_table (ptitle, pcategory, pauthor,pcontent) VALUES ('$title', '$category', '$author','$content')");
			if($query)
			{
				$msg = "Posted!";
				echo "<script> alert('Posted');</script>";
				
			}
		}

?>

<script type="text/javascript">
	$(document).ready(function() {
		var title=document.getElementById('posttitle');
		var category=document.getElementById('postcategory');
		var content=document.getElementById('postcontent');

		
			});
</script>