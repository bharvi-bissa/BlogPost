<?php
	$title="";
	$category="";
	$author="";
	$time="";
	$content="";
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
	/*if(!(isset($_SESSION['user_session']))){
	//mysqli_close($connection); // Closing Connection
	header('Location: loginreg.php'); // Redirecting To Home Page
	}*/
	$msg='';

	/*	$sql="SELECT email FROM post_table";
		$result=mysqli_query($db,$sql);
		//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$title=$row['postitle'];
			$category=$row['postcategory'];
			$author=$row['pauthor'];
			$time=$row['pdatetime'];
			$content=$row['pcontent'];
		}
		*/


?>

<style type="text/css">
	h2{
		font-size: 1.5em;
	}

	p{
		font-size: 1em;
		text-align: justify;
	}

	.wrong{
		
		font-style: italic;
	}

	.contentpara{
		margin-right: 50%;
	}

	a{
	
	}

</style>

<!DOCTYPE html>
<html>
<head>
	<title>Posts</title>
</head>
<body>
		<aside style="float:right;position:relative;margin-left:0.2%;border:0.5px solid #ababab;"><a href="logout.php">Logout</a></aside>
		<aside style="float:right;position:relative;margin-left:0.6%;border:0.5px solid #ababab;"><a href="profile.php">Profile</a></aside>
		<aside style="float:right;position:relative;margin-left:0.8%;border:0.5px solid #ababab;"><a href="editprofile.php">Edit Profile</a></aside>
		<aside style="float:right;position:relative;margin-left:0.10%;border:0.5px solid #ababab;"><a href="adminposts.php">Your Posts</a></aside>
		<aside style="float:right;position:relative;margin-left:0.12%;border:0.5px solid #ababab;"><a href="post.php">Post Something</a></aside>
		<aside style="float:right;position:relative;margin-left:0.14%;border:0.5px solid #ababab;"><a href="home.php">Home</a></aside>
		<aside style="float:right;position:relative;margin-left:0.16%;border:0.5px solid #ababab;"><a href="index.php">Post Index</a></aside>
		<aside style="float:right;position:relative;margin-left:0.18%;border:0.5px solid #ababab;"><a href="editpost.php">Edit Post</a></aside>
		<div><h1 style="text-align:center;">Posts</h1></div>
	<?php

	$sql="SELECT * FROM post_table order by pid desc";
		$result=mysqli_query($db,$sql);
		//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			$cid=$row['pid'];
			$ctitle=$row['ptitle'];
			/*$link_address= "fullpost.php?id="'.$cid.'";*/
			/*$link_address="fullpost.php?id=".$cid&"name=".$ctitle."";*/
			$url = "fullpost.php?id=$cid&title=$ctitle";
			echo "<h2 class=\"wrong\">".$row['ptitle']."</h2>"."By:".$row['pauthor']."<br>";
			echo "At:<h4>".$row['pdatetime'].".</h4>";
			echo "Category :"."<small>".$row['pcategory']."</small>";
			echo "<p class=\"contentpara\">".substr($row['pcontent'],0,500)."...</p>";
			/*echo "<p><a href=\"fullpost.php?id=\" >Read More</a><hr>";*/
			echo '<a href="'.$url.'">Read More</a>';

		}

		?>

		

</body>
</html>