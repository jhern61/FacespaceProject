<?php include('server.php');

session_start();

?>


<?php
$servername = "localhost";
$username = "admin";
$password = "password";
$dbname = "Database";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$post_id=$_POST['post_id'];
//$userid= $_POST['userid'];
$title=$_POST['title'];
$body=$_POST['body'];
$postDate=$_POST['postDate'];
$postDate=$_POST['likes'];


//Get ID from current user.
$name = $_SESSION['username'];

$userID = (int) mysqli_query($con, "SELECT userid FROM user WHERE username = $name");

//INSERT POST IN DATABASE
$sql = "INSERT INTO post (post_id, userid, title, body)
VALUES (default, $userID, '$title', '$body')";

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>New post created successfully!"</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <!-- logged in user information -->
<?php  if (isset($_SESSION['username'])) : ?>
    <p>Welcome <strong><?php echo $name; ?>,</strong></p>

<?php endif ?>
</head>



<body>
  <div class="header">
  	<h2>New post created successfully!</h2>
  </div>

  <form action="index.php">
  <input type="submit" value="Go Home" />
  </form>


  <form action="create_post.php">
  <input type="submit" value="Create Post" />
  </form>


</body>
</html>
