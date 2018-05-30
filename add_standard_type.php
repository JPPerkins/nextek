<?php session_start();
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  die("Connection to database failed. Failed to add type");
}

$type = $_POST["stdTypeListType"];
$description = $_POST["stdTypeListDesc"];
$calCycle = $_POST["stdTypeListCC"];
$location = $_POST["stdTypeListLoc"];
$lastCalMonth = $_POST["stdTypeListLastCalM"];
$lastCalYear = $_POST["stdTypeListLastCalY"];

$sql = "INSERT INTO standardtypelist (std_type, std_desc, std_cal_cycle, std_loc, std_last_cal)
          VALUES ('" . $type . "', '" . $description . "', " . $calCycle . ", '" . $location . "', DATE '" . $lastCalYear . "-" . $lastCalMonth . "-01')";
$result = $conn->query($sql);
mysqli_close($conn);

if(!$result) {
  header("Location: http://" . $servername . $serverroot);
}
header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
?>