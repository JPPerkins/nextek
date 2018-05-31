<?php session_start();
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to add a standard");
}

$std_id = $_POST["std_id"];
$value = $_POST["std_value"];
$equip_id = $_POST["eid"];

$sql = "INSERT INTO equipstdlist (equip_id, std_id, value) VALUES (" . $equip_id . ", " . $std_id . ", " . $value . ")";
echo $sql;
$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>