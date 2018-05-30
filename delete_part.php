<?php session_start();
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
  die("Connection to database failed. Failed to delete comment");
}

$sql = "DELETE FROM partdata WHERE eid = '" . $_POST["tempdeleteitem"] . "'";
$result = $conn->query($sql);
mysqli_close($conn);

header("Location: http://" . $servername . $serverroot);
?>
