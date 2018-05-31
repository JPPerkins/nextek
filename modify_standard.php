<?php session_start();
include("db_header.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to modify a standard");
}

$std_id = $_GET['std_id'];
$std_name = $_POST["std_name"];
$std_type = $_POST["std_type"];
$std_value = $_POST["std_value"];
$std_unit = $_POST["std_unit"];

$sql = "UPDATE standardlist SET std_name = '" . $std_name .  "', std_type = " . $std_type . ", std_value = " . $std_value . ", std_unit = " . $std_unit . " WHERE std_id = " . $std_id;

$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>