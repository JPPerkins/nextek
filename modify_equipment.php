<?php session_start();
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to modify equipment");
}

$eid = $_GET['eid'];
$serial_number = $_POST["serial_number"];
$model_number = $_POST["model_number"];
$equip_type = $_POST["equip_type"];
$equip_location = $_POST["equip_location"];
$equip_viscon = $_POST["equip_viscon"];

$sql = "UPDATE equipmentlist SET serial_number = '" . $serial_number .  "', model_number = '" . $model_number . "', equip_type = " . $equip_type . ", equip_location = " . $equip_location .
          ", equip_viscon = '" .  $equip_viscon . "' WHERE eid = " . $eid;

echo $sql;

$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>