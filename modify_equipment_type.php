<?php session_start();
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to modify an equipment type");
}

$type_id = $_GET['type_id'];
$type_name = $_POST["type_name"];
$tolerance = $_POST["tolerance"];

$sql = "UPDATE typelist SET type_name = '" . $type_name .  "', type_tolerance = " . $tolerance . " WHERE type_id = " . $type_id;
$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>