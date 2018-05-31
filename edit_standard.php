<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <?php 
    $_SESSION["last_page"] = "edit_standard.php?std_id=" . $_GET["std_id"];
    include("db_header.php"); 
  ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo "<title>Nextek - Standard " . $_GET["std_id"] . "</title"; ?>
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
    <br>
    <?php echo "<h2>Standard</h2>"; ?>
    <br>
    <?php if($_SESSION["logged_in"] == true):
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT *, std_value as value FROM standardlist, standardtypelist, unitlist WHERE standardlist.std_id = " . $_GET["std_id"] ." AND standardlist.std_type = standardtypelist.std_tid AND standardlist.std_unit = unitlist.unit_id";
        $result = $conn->query($sql);
        mysqli_close($conn);
        echo $row["value"];

        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>ID</th>
            <th scope=col>Type</th>
            <th scope=col>Value</th>
            <th scope=col>Unit</th>
            <th scope=col>Save</th></tr></thead>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr><th scope=row><form method='post' action='modify_standard.php?std_id=" . $row['std_id'] . "'>";
            echo "<input type='text' class='form-control' name='std_name' value='" . $row["std_name"] . "'></th>";
          
            echo "<td><select class='form-control' name='std_type' value='" . $row["std_type"] . "'>";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql2 = "SELECT * from standardtypelist";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
              echo "<option value=\"" . $row2["std_tid"] . "\">" . $row2["std_type"] . "</option>";
            }
            mysqli_close($conn);
            echo "</select></td>";
            echo "<td><input type='text' class='form-control' name='std_value' value=" . $row['std_value'] . "></td>";

            echo "<td><select class='form-control' name='std_unit' value='" . $row["std_unit"] . "'>";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql2 = "SELECT * from unitlist";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
              echo "<option value=\"" . $row2["unit_id"] . "\">" . $row2["unit_name"] . "</option>";
            }
            mysqli_close($conn);
            echo "</select></td><td><button class='btn btn-info' type='submit'>Save</button></form></td></tr>";
          }
          echo "</table>";
        } else {
            echo "<h3>No standard data found.</h3>";
        }
        echo "</br></br></br>";
        echo "<row><a style='float: left;' class='btn btn-primary' href='standards.php'>Back to Standards</a>";
        echo "<a style='float: right;' class='btn btn-outline-danger' href=\"remove_standard.php?std_id=" . $_GET['std_id'] . "\">Remove Standard</a></row>";
    ?>
    <?php else:
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM standardlist, standardtypelist, unitlist WHERE standardlist.std_id = " . $_GET["std_id"] ." AND standardlist.std_type = standardtypelist.std_tid AND standardlist.std_unit = unitlist.unit_id";
        $result = $conn->query($sql);
        mysqli_close($conn);

        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>ID</th>
            <th scope=col>Type</th>
            <th scope=col>Value</th>
            <th scope=col>Unit</th></tr></thead>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr><th scope=row>" . $row["std_name"] . "</th><td>" . $row["std_type"] . "</td><td>" . $row["std_value"] . "</td><td>" 
            . $row["unit_name"] . "</td></tr>";
          }
          echo "</table>";
        } else {
            echo "<h3>No standard data found.</h3>";
        }
        echo "</br></br></br>";
        echo "<row><a class='btn btn-primary' href='standards.php'>Back to Standards</a></row>"
    ?>
    <?php endif ?>
    </div>
  </body>
</html>