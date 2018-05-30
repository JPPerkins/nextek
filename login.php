<?php session_start();
include("db_header.php");
function Redirect($url, $statuscode = 200) {
  header("Location: " . $url);
}

$conn = $conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  echo "Failed to connect to database, try again later";
}

$username = $_POST["username"];
$redirect_page = $_SESSION["last_page"];

$sql = "SELECT user_id FROM userlist WHERE username = '" . $username . "'";
$result = $conn->query($sql);
mysqli_close($conn);

if ($result->num_rows < 1) {
  Redirect("http://" . $servername . $serverroot . $redirect_page);
}
else {
  $_SESSION["logged_in"] = true;
  $_SESSION["username"] = $username;

  $row = $result->fetch_assoc();
  $_SESSION["uid"] = $row["user_id"];
  Redirect("http://" . $servername . $serverroot . $redirect_page);
}?>
