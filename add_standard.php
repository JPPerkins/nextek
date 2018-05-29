<?php session_start();
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application

// ADD NEW STANDARD FOR PART IN PARTSTANDARDS

include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to create part");
}

$eid = $_POST["eid"];
$stdentry = $_POST["stdentry"];
$requirement = $_POST["requirement"];
$asfound = $_POST["asfound"];
$asleft = $_POST["asleft"];

$sql = "INSERT INTO partstandards (eid, standard, requirement, asfound, asleft) 
VALUES ('" . $eid .  "', '" . $stdentry  . "', '" . $requirement . "', '"  . $asfound . "', '" . $asleft . "')";
$result = $conn->query($sql);
mysqli_close($conn);
if(!$result) {
  header("Location: http://" . $servername . $serverroot);
} 
header("Location: http://" . $servername . $serverroot . "part_entry.php?entry=" . $eid);
?>
