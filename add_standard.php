<?php session_start();
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to add a standard");
}

$std_name = $_POST["std_name"];
$std_type = $_POST["std_type"];
$std_value = $_POST["std_value"];
$std_unit = $_POST["std_unit"];

$sql = "INSERT INTO standardlist (std_name, std_type, std_value, std_unit) VALUES ('" . $std_name . "', " . $std_type . ", " . $std_value . ", " . $std_unit . ")";
$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>