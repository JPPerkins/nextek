<?php session_start();
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to add equipment");
}

$serial_number = $_POST["serial_number"];
$model_number = $_POST["model_number"];
$equip_type = $_POST["equip_type"];
$equip_location = $_POST["equip_location"];

$sql = "INSERT INTO equipmentlist (serial_number, model_number, equip_type, equip_location) VALUES ('" . $serial_number . "', '" . $model_number . "', " . $equip_type . ", " . $equip_location . ")";
$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>