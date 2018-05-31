<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <?php 
    $_SESSION["last_page"] = "edit_standards.php";
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
    <!-- caltech table -->
    <?php
      $conn = new mysqli($servername, $username, $password, $dbname);
      $sql = "SELECT * FROM standards, stdtype WHERE standards.stdtype = stdtype.type";
      $result = $conn->query($sql);
      mysqli_close($conn);
      
      if ($result->num_rows > 0) {
        echo "<table><col width=150><col width=150><col width=150><col width=150><col width=150><col width=150><col width=150>";
        echo "<tr><td><h2>Standards</h2></td></tr>";
        echo "<tr><td><h5>Name</h5></td><td><h5>Type</h5></td><td><h5>Value</h5></td><td><h5>Unit</h5></td><td><h5>Tolerance</h5></td><td><h5>Low</h5></td><td><h5>High</h5></td></tr>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["stdid"] . "</td><td>" . $row["stdtype"] . "</td><td>" . $row["stdvalue"] . "</td>
          <td>" . $row["stdunit"] . "</td><td>" . $row["tolerance"] . "</td><td>" . (1 - $row["tolerance"]) * $row["stdvalue"] . "</td><td>" . (1 + $row["tolerance"]) * $row["stdvalue"] . "</td></tr>";
        } 
      } else {
          echo "<h2>There are no Standards.</h2>";
      }
      echo "</table>";
      mysqli_close($conn);
    ?>

    </br></br></br>

    <!-- add standard -->
    <form method="post" action="create_standard.php">
      <label for="stdname">Standard: </label>
      <input type="textarea" name="stdname">
      <label for="stdtype">Type: </label>
      <select name="stdtype">
        <?php
          $conn = new mysqli($servername, $username, $password, $dbname);
          $sql = "SELECT type from stdtype";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value=\"" . $row["type"] . "\">" . $row["type"] . "</option>";
            }
          }
          else {
            echo "No Types Inputted";
          }
          mysqli_close($conn);
        ?>
      </select>
      <label for="stdvalue">Value: </label>
      <input type="textarea" name="stdvalue">
      <label for="stdunit">Unit: </label>
      <select name="stdunit">
        <?php
          $conn = new mysqli($servername, $username, $password, $dbname);
          $sql = "SELECT unit from stdunit";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value=\"" . $row["unit"] . "\">" . $row["unit"] . "</option>";
            }
          }
          else {
            echo "No Units Inputted";
          }
          mysqli_close($conn);
        ?>
      </select>
      <input type="submit" value="Add Standard">
    </form>

    <form method="post" action="add_type.php">
      <label for="typename">New Type: </label>
      <input type="textarea" name="typename">
      <label for="tolvalue">Tolerance: </label>
      <input type="textarea" name="tolvalue">
      <input type="submit" value="Add Type">
    </form>   
    <form method="post" action="add_unit.php">
      <label for="unitname">New Unit: </label>
      <input type="textarea" name="unitname">
      <input type="submit" value="Add Unit">
    </form>
  </div>
</body>
</html>
