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
$title=$_POST['title'];
$body=$_POST['body'];
$postDate=$_POST['postDate'];

//Inserting post data
$sql = "INSERT INTO post (post_id, title, body)
VALUES (default, '$title', '$body')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();



echo "<br>";
echo $title;
echo "<br>";
echo $body;
echo "<br>";
echo $postDate;
echo "<br>";

?>
