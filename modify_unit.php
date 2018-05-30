<?php session_start();
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to modify an unit");
}

$unit_id = $_GET['unit_id'];
$unit_name = $_POST["unit_name"];

$sql = "UPDATE unitlist SET unit_name = '" . $unit_name .  "' WHERE unit_id = " . $unit_id;
echo $sql;
$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>