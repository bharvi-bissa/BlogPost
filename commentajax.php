<?php
	session_start();
	define('DB_SERVER', '127.0.0.1');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'bloguser');
	$uname="";
	$db = @mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die(mysqli_error());
	
	$uname=$_SESSION['user_session'];
	
	@$poster=mysqli_escape_string($db,$_POST['posttitle']);
	

	if (isset($_POST['done'])){
		if(!(isset($_SESSION['user_session']))){
		//mysqli_close($connection); // Closing Connection
		echo "Sign in First!";// Redirecting To Home Page
		}
		else{
			$mycomment=mysqli_escape_string($db,$_POST['comment_text']);
			$posttitle=mysqli_escape_string($db,$_POST['postname']);
			mysqli_query($db,"INSERT INTO comments (c_author,c_post,comment) values ('$uname','$posttitle','$mycomment')");
			
			exit();
			}
	}


	if(isset($_POST['display'])){
		
		$result=mysqli_query($db,"SELECT * FROM comments WHERE c_post='$poster'");

		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			?>
			<div id="comment_box">
				<p><?php echo $row['c_author']; ?></p>
				<p><?php echo $row['comment']; ?></p>
			</div>
				<?php
		}
		exit();
	}
?>
