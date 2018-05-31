<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <?php 
    $_SESSION["last_page"] = "edit_equipment.php?eid=" . $_GET["eid"];
    include("db_header.php"); 
  ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo "<title>Nextek - Equipment " . $_GET["eid"] . "</title"; ?>
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
    <?php echo "<h2>Equipment</h2>"; ?>
    <br>
    <?php if($_SESSION["logged_in"] == true):
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM equipmentlist, typelist, locationlist WHERE equipmentlist.equip_location = locationlist.location_id AND equipmentlist.equip_type = typelist.type_id";
        $result = $conn->query($sql);
        mysqli_close($conn);

        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>Serial Number</th>
            <th scope=col>Model Number</th>
            <th scope=col>Type</th>
            <th scope=col>Tolerance</th>
            <th scope=col>Location</th>
            <th scope=col>Visual Condition</th>
            <th scop=col>Save</th></tr></thead>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr><th scope=row><form method='post' action='modify_equipment.php?eid=" . $_GET['eid'] . "'>";
            echo "<input type='text' class='form-control' name='serial_number' value='" . $row["serial_number"] . "'></th>";
            echo "<td><input type='text' class='form-control' name='model_number' value='" . $row['model_number'] . "'></td>
              <td><select class='form-control' name='equip_type' value='" . $row["equip_type"] . "'>";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql2 = "SELECT * from typelist";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
              echo "<option value=\"" . $row2["type_id"] . "\">" . $row2["type_name"] . "</option>";
            }
            mysqli_close($conn);

            echo "</td><td><input class='form-control' id='readOnlyInput' type='text' value=" . $row["type_tolerance"] * 100 . "% readonly='' size='2'></td>
            <td><select class='form-control' name='equip_location' value='" . $row["equip_location"] . "'>";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql2 = "SELECT * from locationlist";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
              echo "<option value=\"" . $row2["location_id"] . "\">" . $row2["location_name"] . "</option>";
            }
            mysqli_close($conn);

            echo "</td><td><select class='form-control' name='equip_viscon' value='" . $row["equip_viscon"] . "'>";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql2 = "SELECT * from conditionlist";
            $result2 = $conn->query($sql2);
            while ($row2 = $result2->fetch_assoc()) {
              echo "<option value=\"" . $row2["cond_quality"] . "\">" . $row2["cond_quality"] . "</option>";
            }
            mysqli_close($conn);
            echo "</td><td><button class='btn btn-info' type='submit'>Save</button></form></td></tr>";
          }
          echo "</table>";
        } else {
            echo "<h3>No standard data found.</h3><br><br>";
        } ?>
        
        <div class="container">
        <h3>Standards</h3>
        </div>
        <?php /*if($_SESSION["logged_in"] == true):
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
        echo "<a style='float: right;' class='btn btn-outline-danger' href=\"remove_standard.php?std_id=" . $_GET['std_id'] . "\">Remove Standard</a></row>";*/
    ?>
    <?php endif ?>
    </div>
  </body>
</html>