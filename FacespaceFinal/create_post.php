<?php  include('server.php');


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

  // define variables and set to empty values
  $title = $username = $body = $post_id = "";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["body"])) {
      $body = "";
    } else {
      $body = test_input($_POST["body"]);
    }

    if (empty($_POST["postDate"])) {
      $postDate = "";
    } else {
      $postDate = test_input($_POST["postDate"]);
    }

  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>


<!-- //HTML STUFF  -->
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>FaceSpace</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


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
<body>

  <!-- logged in user information -->
<?php  if (isset($_SESSION['username'])) : ?>
		<p>Welcome <strong><?php echo $_SESSION['username']; ?>,</strong></p>

<?php endif ?>



<form method="post" action="save_post.php">
  <h2> Create Post </h2>
  <br><br>
  Title: <br><input type="text" name="title" value="<?php echo $title;?>">
  <br><br>
  What's on your mind? <br> <input type="text" name="body" value="<?php echo $body;?>">
  <br><br>

  <input type="submit" name="submit" value="Post">
  <div class="btn">
    <a href="index.php"> Cancel </a>
  </div>

</form>





</body>
</html>
