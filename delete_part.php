<?php session_start();
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");

// 10) After log in, user deletes a particular comment to a post he/she has created

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
  die("Connection to database failed. Failed to delete comment");
}

$sql = "DELETE FROM partdata WHERE eid = '" . $_POST["tempdeleteitem"] . "'";
$result = $conn->query($sql);
mysqli_close($conn);

header("Location: http://" . $servername . $serverroot);
?>
