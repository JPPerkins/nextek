<?php session_start();
include("db_header.php");

if(isset($_SESSION["logged_in"])) {
  session_unset();
  session_destroy();
  header("Location: http://" . $servername . $serverroot . $_SESSION["last_page"]);
}
?>