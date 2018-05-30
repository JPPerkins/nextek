<?php session_start();
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to delete comment");
}

$sql = "DELETE FROM standardtypelist WHERE std_tid = '" . $_GET['tid'] . "'";
$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . "standard_types.php");
?>