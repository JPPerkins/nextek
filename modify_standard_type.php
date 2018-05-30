<?php session_start();
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to add type");
}

$tid = $_POST["stdTypeID"];
$type = $_POST["stdTypeListType"];
$description = $_POST["stdTypeListDesc"];
$calCycle = $_POST["stdTypeListCC"];
$location = $_POST["stdTypeListLoc"];
$lastCalMonth = $_POST["stdTypeListLastCalM"];
$lastCalYear = $_POST["stdTypeListLastCalY"];


$sql = "UPDATE standardtypelist SET std_type = '" . $type . "', std_desc = '" . $description . "', std_cal_cycle = "
   . $calCycle . ", std_loc = '" . $location . "', std_last_cal = DATE '" . $lastCalYear . "-" . $lastCalMonth . "-01' WHERE std_tid = " . $tid;

$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>