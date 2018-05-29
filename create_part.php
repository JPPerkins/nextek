<?php session_start();
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to create part");
}

$parttype = $_POST["parttype"];
$eid = $_POST["eid"];
$visfound = $_POST["visfound"];
$asfound = $_POST["asfound"];
$asleft = $_POST["asleft"];

$sql = "INSERT INTO partdata (date_time, caltech, parttype, eid, visasfound, asfound, asleft) 
VALUES (NOW(), '" . $_SESSION["username"] . "', '" . $parttype . "', '" . $eid . "', '" . $visfound . "', '" . $asfound . "', '" . $asleft . "')";
$result = $conn->query($sql);
mysqli_close($conn);
if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . "part_entry.php?entry=" . $eid);
?>
