<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <?php 
    $_SESSION["last_page"] = "part_entry.php?entry=" . $_GET["entry"];
    include("db_header.php");
    $seid_name = $_GET["entry"]; 
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
        $sql = "SELECT * FROM partdata, parttype WHERE eid = '" . $seid_name . "' AND partdata.parttype = parttype.Name";
        $result = $conn->query($sql);
        mysqli_close($conn);

        if($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $N_datetime = $row["date_time"];
          $timestamp = strtotime($N_datetime);
          $date = date('m/d/Y', $timestamp);
          $timestamp = strtotime($N_datetime . " + 365 day");
          $N_date = date('m/d/Y', $timestamp);
          $tolerance = $row["typetol"];
        } else {
          echo "error";
        }

    // DISPLAY PART INFORMATION


        echo "<br><table><col width=200><col width=200><col width=200><col width=200><col width=200><col width=200>";
        echo "<tr><td>ID: " . $row["eid"] . "</td><td>Model: " . $row["eid"] . "</td><td>Date: " . $date . "</td><td>Cal Tech: " . $row["caltech"] . "</td>
              <td>Type: " . $row["parttype"] . "</td><td>Tolerance: " . $row["typetol"] * 100 . "%</td></tr>";
        echo "</table>";
        echo "</br></br>";
        echo "<h3>Standards:</h3></br>";

    // DISPLAY STANDARD INFORMATION

    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT * FROM partstandards, standards WHERE partstandards.eid = '" . $seid_name . "' AND partstandards.standard = standards.stdid";
    $result = $conn->query($sql);
    mysqli_close($conn);
    $VALID = TRUE;

    if($result->num_rows > 0) {
      echo "<table><col width=200><col width=200><col width=200><col width=200><col width=200><col width=200>";
      echo "<tr><td>ID</td><td>Requirement</td><td>Low</td><td>High</td><td>Measurement</td><td>Valid</td></tr>";
      while ($row = $result->fetch_assoc()) {
        $measurement = $row["asfound"];
        $lowreq = $row["stdvalue"] * (1 - $tolerance);
        $highreq = $row["stdvalue"] * (1 + $tolerance);
        echo "<tr><td>" . $row["stdid"] . "</td><td>" . $row["stdvalue"] . " " . $row["stdunit"] . "</td><td>" . $lowreq . " " . $row["stdunit"] . "</td><td>"
        . $highreq . " " . $row["stdunit"] . "</td><td>" . $measurement . "</td><td>";
        if ($measurement <= $highreq && $measurement >= $lowreq) {
          echo "PASS</td></tr>";
        } else {
          echo "FAIL</td></tr>";
          $VALID = FALSE;
        }
      }
    } else {
      echo "<h3>No Standards for this Part Exist.</h3></br>";
    }
    echo "</table>";
    echo "</br><h3>";
    if ($VALID) { 
      echo "PASS</h3>";
    } else {
      echo "FAIL</h3>";
    }
    echo "</br>Next Cal Due Date: " . $N_date;

    /*if ($result->num_rows > 0) {
      echo "<table><col width=130><col width=80><col width=130><col width=150><col width=200><col width=200><col width=200>";
      echo "<tr><td>Entered</td><td>Cal Tech</td><td>Type</td><td>EID</td><td>Visual As Found</td><td>Condition As Found</td><td>Condition as Left</td></tr>";
      while ($row = $result->fetch_assoc()) {
        $N_datetime = $row["date_time"];
        $timestamp = strtotime($N_datetime);
        $N_date = date('m/d/Y', $timestamp);
        echo "<tr><td>" . $N_date . "</td><td>" . $row["caltech"] . "</td><td>" . $row["parttype"] . "</td><td>"
          . $row["eid"] . "</td><td>" . $row["visasfound"] . "</td><td>" . $row["asfound"] . "</td><td>" . $row["asleft"] . "</td></tr>";
      } 
    } else {
        echo "<h2>partdata has no data.</h2>";
    }
    echo "</table></br></br></br></br>";
    mysqli_close($conn);*/
  ?>
  </br></br></br>
  <form method="post" action="add_standard.php">
    <label for="stdentry">Add a Standard: </label>
    <input type="hidden" name="eid" value= <?php echo $seid_name ?>>
    <select name="stdentry">
      <?php
      $conn = new mysqli($servername, $username, $password, $dbname);
      $sql = "SELECT stdid from standards";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<option value=\"" . $row["stdid"] . "\">" . $row["stdid"] . "</option>";
        }
      }
      else {
        echo "No Standards to chose from";
      }
      mysqli_close($conn);
      ?>
    </select>
    <label for="measurement">Measurement: </label>
    <input type="textarea" name="measurement">
    <input type="submit" value="Enter">
  </form>

  <?php /*
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT * FROM partstandards, standards WHERE partstandards.eid = '" . $seid_name . "' AND partstandards.standard = standards.standardname";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table><col width=200><col width=200><col width=200><col width=200><col width=200>";
      echo "<tr><td>Standard</td><td>Description</td><td>Requirement</td><td>As Found</td><td>As Left</td></tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["standard"] . "</td><td>" . $row["description"] . "</td><td>" . $row["requirement"] . "</td><td>" . $row["asfound"] . "</td><td>" . $row["asleft"] . "</td></tr>";
      } 
    } else {
        echo "<h2>no standards inputted.</h2>";
    }
    echo "</table></br></br></br></br>";
    mysqli_close($conn); */
  ?>
  </br></br>
  <form method="post" action="delete_part.php">
    <label for="tempdeleteitem">Delete Part</label>
    <input type="hidden" name="tempdeleteitem" value= <?php echo $seid_name ?>>
    <input type="submit" value="Confirm">
  </form>


  </div>
</body>
</html>
