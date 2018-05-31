<?php session_start();
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to modify a location");
}

$location_id = $_GET['location_id'];
$location_name = $_POST["location_name"];

$sql = "UPDATE locationlist SET location_name = '" . $location_name .  "' WHERE location_id = " . $location_id;
$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>