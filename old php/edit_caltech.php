<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <?php 
    $_SESSION["last_page"] = "index.php";
    include("db_header.php"); 
  ?>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nextek - Caltech</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
  </head>
  <body>
    <?php
      include("navbar.php");
      $conn = new mysqli($servername, $username, $password);
      if($conn->connect_error) {
        die("Connection Failed");
      }
      mysqli_close($conn);
    ?>
    <div class="container">
      <?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM caltech";
        $result = $conn->query($sql);
        mysqli_close($conn);

        if ($result->num_rows > 0) {
          echo "<br><h2>Cal Techs</h2><br>";
          echo "<table><col width=200>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["uname"] . "</td></tr>";
          } 
        } else {
            echo "<h2>There are no Cal Techs.</h2>";
        }
        echo "</table>";   
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