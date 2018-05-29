<?php session_start();
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to add unit");
}

$unitname = $_POST["unitname"];

$sql = "INSERT INTO stdunit (unit) VALUES ('" . $unitname . "')";
$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>
