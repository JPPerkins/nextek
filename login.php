<?php
session_start();
function Redirect($url, $statuscode = 200) {
  header("Location: " . $url);
}
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");

$conn = $conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  echo "Failed to connect to database, try again later";
}

$caltech = $_POST["caltech"];

if ($upass == "") {
  Redirect("https://" . $servername . $serverroot);
}
$redirect_page = $_SESSION["last_page"];

$sql = "SELECT uid FROM caltech WHERE uname = '" . $caltech . "'";

$result = $conn->query($sql);
mysqli_close($conn);
if ($result->num_rows < 1) {
  Redirect("http://" . $servername . $serverroot . $redirect_page);
}
else {
  $_SESSION["logged_in"] = true;
  $_SESSION["username"] = $caltech;

  $row = $result->fetch_assoc();
  $_SESSION["uid"] = $row["uid"];
  Redirect("http://" . $servername . $serverroot . $redirect_page);
}?>
