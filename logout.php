<?php session_start();
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");
if(isset($_SESSION["logged_in"])) {
  session_unset();
  session_destroy();
  header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
}
