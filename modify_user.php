<?php session_start();
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to modify a user");
}

$uid = $_GET['uid'];
$username = $_POST["username"];

echo $uid;
echo $username;

$sql = "UPDATE userlist SET username = '" . $username .  "' WHERE user_id = " . $uid;
$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>