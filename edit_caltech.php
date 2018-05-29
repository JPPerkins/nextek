<?php session_start(); ?>
<!DOCTYPE html>
<?php
// include("db_header.php") is just an easy way to allow local settings
// configuration quickly by changing 1 file to update the whole application
include("db_header.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
  $conn_failure = true;
}
else {
  $conn_failure = false;
}

$_SESSION["last_page"] = "edit_caltech.php";

?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>Nextek - Caltech</title>
</head>
<body>
  <div class="container">
    <!-- caltech table -->
    <?php
      include("banner.php");
      $conn = new mysqli($servername, $username, $password, $dbname);
      $sql = "SELECT * FROM caltech";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<table><col width=200>";
        echo "<tr><td><h2>Cal Techs</h2></td></tr>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["uname"] . "</td></tr>";
          /*echo "<form method=\"post\" action=\"delete_caltech.php\">";
          echo "<input name=\"ctdelete\" input type=\"hidden\" value=" . $row["uid"] . ">";
          echo "<input type=\"submit\" value=\"Delete\">";
          echo "</tr>";*/
        } 
      } else {
          echo "<h2>There are no Cal Techs.</h2>";
      }
      echo "</table>";
      mysqli_close($conn);
    ?>

    </br></br></br>

    <!-- add caltech -->
    <form method="post" action="add_caltech.php">
      <label for="caltechid">ID: </label>
      <input type="textarea" name="caltechid">
      <input type="submit" value="Add Caltech">
    </form>
  </div>
</body>
</html>
