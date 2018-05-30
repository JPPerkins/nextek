<?php session_start();
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to add an equipment type");
}

$type_name = $_POST["type_name"];
$tolerance = $_POST["tolerance"];

$sql = "INSERT INTO typelist (type_name, type_tolerance) VALUES ('" . $type_name . "', " . $tolerance . ")";
$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>