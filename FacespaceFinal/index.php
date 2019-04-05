<?php
	// connect to the database
	$con = mysqli_connect('localhost', 'Admin', 'Password', 'Database');

	//Session stuff
	session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }




  // LIKE FUNCTION
  if (isset($_POST['liked'])) {
		$post_id = $_POST['post_id'];
		$result = mysqli_query($con, "SELECT * FROM post WHERE post_id=$post_id");
	  $row = mysqli_fetch_array($result);
		$n = $row['likes'];

		mysqli_query($con, "INSERT INTO likes (userid, post_id) VALUES (1, $post_id)");
		mysqli_query($con, "UPDATE post SET likes=$n+1 WHERE post_id=$post_id");

		echo $n+1;
		exit();
	}

  // UNLIKED POST FUNCTOIN
  if (isset($_POST['unliked'])) {
		$post_id = $_POST['post_id'];
		$result = mysqli_query($con, "SELECT * FROM post WHERE post_id=$post_id");
		$row = mysqli_fetch_array($result);
		$n = $row['likes'];

		mysqli_query($con, "DELETE FROM likes WHERE post_id=$post_id AND userid=1");
		mysqli_query($con, "UPDATE post SET likes=$n-1 WHERE post_id=$post_id");

		echo $n-1;
		exit();
	}


  // Retrieve posts from the database
	$posts = mysqli_query($con, "SELECT * FROM post");

	$authors = mysqli_query($con, "SELECT username FROM user
		JOIN post ON user.userid = post.userid")

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FaceSpace</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">



	<div class="fixed-header">
        <div class="container">
            <nav>
                <a href="index.php">FaceSpace</a>
                <a href="index.php">Home</a>
                <a href="create_post.php">Create Post</a>
                <a href="login.php">Logout</a>

            </nav>
        </div>
    </div>
 </head>

 <?php  while ($row = $authors->fetch_assoc()) {
     $author =  $row['username'];
 }
	?>


<body>
	<!-- logged in user information -->
<?php  if (isset($_SESSION['username'])) : ?>
		<p>Welcome <strong><?php echo $_SESSION['username']; ?>,</strong></p>

<?php endif ?>


	<!-- display posts gotten from the database  -->
		<?php while ($row = mysqli_fetch_array($posts)) { ?>

			<div class="post">
				<?php
         echo "<b>";
         echo $row['title'];
         echo "</b>";
         echo "<br><br>";
         echo "User: ";
				 //echo $row['userid'];
				 echo $author;

         echo "<br><br>";
         echo $row['body'];
         echo "<br><br><br>";
         echo "Date Posted: ";
         echo $row['postDate'];
         echo "<br>";
         echo "--------------------------------------------- "; ?>


				<div style="padding: 2px; margin-top: 5px;">
				<?php


        $results = mysqli_query($con, "SELECT * FROM likes WHERE userid=1 AND post_id=".$row['post_id']."");

        if (mysqli_num_rows($results) == 1 ): ?>
          <!-- user already likes post -->
          <span class="unlike fa fa-thumbs-up" data-id="<?php echo $row['post_id']; ?>"></span>
          <span class="like hide fa fa-thumbs-o-up" data-id="<?php echo $row['post_id']; ?>"></span>
        <?php else: ?>
          <!-- user has not yet liked post -->
          <span class="like fa fa-thumbs-o-up" data-id="<?php echo $row['post_id']; ?>"></span>
          <span class="unlike hide fa fa-thumbs-up" data-id="<?php echo $row['post_id']; ?>"></span>
        <?php endif ?>


					<span class="likes_count"><?php echo $row['likes']; ?> likes</span>
				</div>
			</div>

		<?php } ?>




<!-- Add Jquery to page -->
<script src="jquery.min.js"></script>
<script>
	$(document).ready(function(){
		// when the user clicks on like
		$('.like').on('click', function(){
			var post_id = $(this).data('id');
			    $post = $(this);

			$.ajax({
				url: 'index.php',
				type: 'post',
				data: {
					'liked': 1,
					'post_id': post_id
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});

		// when the user clicks on unlike
		$('.unlike').on('click', function(){
			var post_id = $(this).data('id');
		    $post = $(this);

			$.ajax({
				url: 'index.php',
				type: 'post',
				data: {
					'unliked': 1,
					'post_id': post_id
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});
	});
</script>
</body>
</html>
