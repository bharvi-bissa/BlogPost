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
	
	/*if(!(isset($_SESSION['user_session']))){
	header('Location: loginreg.php'); // Redirecting To Home Page
	}*/
	$msg='';
	$cid=$_GET['id'];
	$ctitle=$_GET['title'];
	/*$uname=$_SESSION['user_session'];*/
	$sql="SELECT * FROM post_table where pid='$cid' ";
	/*$query="SELECT * FROM members WHERE username='$uname'";*/
	$result=mysqli_query($db,$sql);
	/*$commresult=mysqli_query($db,$query);*/	

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

	li{
		list-style: none;
	}
	textarea{
		resize: none;
	}
</style>

<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<title><?php  ?></title>
</head>
<body>

 	<?php 
 		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			
			echo "<h2 class=\"wrong\">".$row['ptitle']."</h2>"."By:".$row['pauthor']."<br>";
			echo "At:<h4>".$row['pdatetime'].".</h4>";
			echo "Category :"."<small>".$row['pcategory']."</small>";
			echo "<p class=\"contentpara\">".$row['pcontent']."</p>";
			
			

		}
 	?>
 		<div id="display_area">
 			
 		</div>

 		<div id="comment_input_form">
 			<li>Comment :</li>
 			<li><textarea rows="8" cols="40" id="comment" ></textarea></li>
 			<li><input type="submit" name="submit" value="Post" id="submit_comment"></li>
 		</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		displayfromdatabase();
		var pnames="<?php echo htmlspecialchars($ctitle); ?>";
		
		$.ajax({
			url:"commentajax.php",
			type:"POST",
			async:"false",
			data:{
				"yo":1,
				"posttitle":pnames	
			},
			success:function(dd){

			}

		});
		$("#submit_comment").click(function(){
			var comment = $("#comment").val();
			var pname="<?php echo htmlspecialchars($ctitle); ?>";
			
			$.ajax({
				url:"commentajax.php",
				type:"POST",
				async:"false",
				data:{
					"done":1,
					"comment_text":comment,
					"postname":pname
				},
				success:function(data){
					displayfromdatabase();
					$("#comment").val('');
				}
			});
		});
	});

	function displayfromdatabase(){
		$.ajax({
			url:"commentajax.php",
			type:"POST",
			async:"false",
			data:{
				"display":1
			},
			success:function(d){
				$("#display_area").html(d);

			}
		});
	}

	
</script>