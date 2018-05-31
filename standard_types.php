<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <?php $_SESSION["last_page"] = "standard_types.php"; ?>
  <?php include("db_header.php"); ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nextek - Standard Types</title>
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
      <h2>Standard Types</h2>
      <br>
      <?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM standardtypelist, locationlist WHERE std_loc = location_id";
        $result = $conn->query($sql);
        mysqli_close($conn);
        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>Type</th>
            <th scope=col>Description</th>
            <th scope=col>Cal Cycle</th>
            <th scope=col>Location</th>
            <th scope=col>Last Cal</th>
            <th scope=col>Next Cal</th>
            <th scope=col>Edit</th></tr></thead>";
          while ($row = $result->fetch_assoc()) {
            $dateTime = $row["std_last_cal"];
            $dateString = strtotime($dateTime);
            $lastCalDate = date('m/Y', $dateString);
            $dateString = strtotime($dateTime . " + " . $row["std_cal_cycle"] . " years");
            $nextCalDate = date('m/Y', $dateString);
            echo "<tr><th scope=row>" . $row["std_type"] . "</th><td>" . $row["std_desc"] . "</td><td>" . 
              $row["std_cal_cycle"]  . " Years</td><td>" . $row["location_name"] . "</td><td>" . $lastCalDate . 
              "</td><td>" . $nextCalDate . "</td><td><a class='btn btn-outline-info btn-sm' href=\"edit_standard_type.php?tid=" . $row['std_tid'] . "\">Edit</a></td></tr>";
          }
          echo "</table>";
        } else {
            echo "<h3>No standard type data found.</h3>";
        }

      ?>
      </br></br></br>

      <?php if($_SESSION["logged_in"] == true): ?>
        <form method="post" action="add_standard_type.php">
          <fieldset>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="col-form-label" for="stdTypeListType">Type</label>
                  <input type="text" class="form-control" name="stdTypeListType" placeholder="Type">
                </div>
              </div>
              <div class="col-lg-8">
                <div class="form-group">
                    <label class="col-form-label" for="stdTypeListDesc">Description</label>
                    <input type="text" class="form-control" name="stdTypeListDesc" placeholder="Description">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="col-form-label" for="stdTypeListCC">Cal Cycle</label>
                  <input type="text" class="form-control" name="stdTypeListCC" placeholder="Cal Cycle">
                  <small id="calcycleHelp" class="form-text">In Years</small>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="col-form-label" for="stdTypeListLoc">Location</label>
                  <select class="form-control" name="stdTypeListLoc">
                    <?php
                      $conn = new mysqli($servername, $username, $password, $dbname);
                      $sql = "SELECT * from locationlist";
                      $result = $conn->query($sql);
                      while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["location_id"] . "\">" . $row["location_name"] . "</option>";
                      }
                      mysqli_close($conn);
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  <label class="col-form-label" for="stdTypeListLastCalM">Last Calibration Date</label>
                  <input type="text" class="form-control" name="stdTypeListLastCalM" placeholder="Month">
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  <label class="col-form-label" for="stdTypeListLastCalY">MM / YYYY</label>
                  <input type="text" class="form-control" name="stdTypeListLastCalY" placeholder="Year">
                </div>
              </div>
            </div>   
            <button type="submit" class="btn btn-primary">Submit</button>     
          </fieldset>
        </form>
        <?php endif ?>
    </div>
  </body>
</html>