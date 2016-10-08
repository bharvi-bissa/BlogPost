<?php
	$msg="";
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
	#text{
		font-size: 1.5em;
	}
	.mydiv{
		margin-left: 20%;
	}
	textarea{
		resize: none;
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
		<aside style="float:right;position:relative;margin-left:0.16%;border:0.5px solid #ababab;"><a href="index.php">Post Index</a></aside>
		<aside style="float:right;position:relative;margin-left:0.18%;border:0.5px solid #ababab;"><a href="editpost.php">Edit Post</a></aside>
		<div><h1 style="text-align:center;">Edit Post</h1></div>
		<div class="mydiv">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		  <select name="selectinput" >
		  <option>Select Post Title</option>
		    <?php
		    	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		    		
			    	/*echo "<option value=".strval($row['ptitle']).">".strval($row['ptitle'])."</option>";*/
			    	echo "<option value=\"" . htmlentities($row['ptitle']) . "\">" . strval($row['ptitle']) . "</option>" . "<br />";  
				}
			?>
		  </select>
		  <br><br>
		  <input type="submit" value="Edit" name="submit">
		</form>
		<table>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<?php
					if(isset($_POST['submit'])){
					$posttitle=$_POST['selectinput'];
					}
					$result2=@mysqli_query($db,"SELECT * FROM post_table WHERE ptitle='$posttitle' AND pauthor='$uname'");
					while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
						
						$postcontent=$row2['pcontent'];
						$postcategory=$row2['pcategory'];
						$posttitle=$row2['ptitle'];
						$pid=$row2['pid'];
						

						echo '<tr><td></td><td><input class="text" type="hidden" id="pid" name="postid" value="'. $pid .'"></td></tr><br/>';
						echo '<tr><td>Title :</td><td><input class="text" type="text" id="posttitle" name="posttitle" value="'. $posttitle .'"></td></tr><br/>';
						echo '<tr><td>Category :</td><td><input class="text" type="text" id="postcategory" name="npostcategory" value="'. $postcategory .'"></td></tr><br/>';
						echo '<tr><td>Content :</td><td><textarea type=text id=text cols="66" rows="10" name="npostcontent">'.$postcontent.'</textarea><br></td></tr>';
						
						echo '<td><input type="submit" value="Update" name="update"></td>';
						
				}
				?>
				</form>
		</table>

		<?php

			if(isset($_POST['update'])){
				$npcategory=mysqli_escape_string($db,$_POST['npostcategory']);
				$npcontent=mysqli_escape_string($db,$_POST['npostcontent']);
				$nptitle=mysqli_escape_string($db,$_POST['posttitle']);
				$npid=$_POST['postid'];

				if(empty($npcategory) || empty($npcontent)){
					$postcategory="";
					$postcontent="";
					echo '<tr><td>Category :</td><td><input class="text" type="text" id="postcategory" name="npostcategory" value="'. $postcategory .'"></td></tr><br/>';
					echo '<tr><td>Content :</td><td><textarea type="text" id="text" cols="66" rows="10" name="npostcontent">'.$postcontent.'</textarea><br></td></tr>';
						
					echo '<tr><td><input type="submit" value="Update" name="update"></td></tr>';
					echo "<script>alert('Please Fill all the Fields!');</script>";
					

				}
					else{
					$result3=mysqli_query($db,"UPDATE post_table SET ptitle='$nptitle',pcategory='$npcategory',pcontent='$npcontent' WHERE pauthor='$uname' AND pid='$npid'" );
					echo "<script>alert('Post updated Successfully.');</script>";
					}
				}
		?>
		</div>

		
		
		


</body>
</html>