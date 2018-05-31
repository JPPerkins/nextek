<?php session_start();
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application

// INSERT NEW STANDARD INTO STANDARDS

include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to create part");
}

$stdname = $_POST["stdname"];
$stdtype = $_POST["stdtype"];
$stdunit = $_POST["stdunit"];
$stdvalue = $_POST["stdvalue"];

$sql = "INSERT INTO standards (stdid, stdtype, stdvalue, stdunit) 
VALUES ('" . $stdname . "', '" . $stdtype . "', " . $stdvalue . ", '" . $stdunit . "')";
echo $sql;
$result = $conn->query($sql);
mysqli_close($conn);
if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>
