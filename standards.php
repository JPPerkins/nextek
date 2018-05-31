<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <?php $_SESSION["last_page"] = "standards.php"; ?>
  <?php include("db_header.php"); ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nextek - Standards</title>
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
      <h2>Standards</h2>
      <br>
      <?php if($_SESSION["logged_in"] == true):
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM standardlist, standardtypelist, unitlist WHERE standardlist.std_type = standardtypelist.std_tid AND standardlist.std_unit = unitlist.unit_id";
        $result = $conn->query($sql);
        mysqli_close($conn);

        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>ID</th>
            <th scope=col>Type</th>
            <th scope=col>Value</th>
            <th scope=col>Unit</th>
            <th scope=col>Edit</th></tr></thead>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr><th scope=row>" . $row["std_name"] . "</th><td>" . $row["std_type"] . "</td><td>" . $row["std_value"] . "</td><td>" 
            . $row["unit_name"] . "</td><td><a class='btn btn-outline-info btn-sm' href=\"edit_standard.php?std_id=" . $row['std_id'] . "\">Edit</a></td></tr>";
          }
          echo "</table>";
        } else {
            echo "<h3>No standard data found.</h3>";
        } ?>
        <form method="post" action="add_standard.php">
          <fieldset>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="col-form-label" for="std_name">Name</label>
                  <input type="text" class="form-control" name="std_name" placeholder="Name">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="col-form-label" for="std_type">Standard Type</label>
                  <select class="form-control" name="std_type">
                    <?php
                      $conn = new mysqli($servername, $username, $password, $dbname);
                      $sql = "SELECT * from standardtypelist";
                      $result = $conn->query($sql);
                      while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["std_tid"] . "\">" . $row["std_type"] . "</option>";
                      }
                      mysqli_close($conn);
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="col-form-label" for="std_value">Value</label>
                  <input type="text" class="form-control" name="std_value" placeholder="Value">
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  <label class="col-form-label" for="std_unit">Standard Unit</label>
                  <select class="form-control" name="std_unit">
                    <?php
                      $conn = new mysqli($servername, $username, $password, $dbname);
                      $sql = "SELECT * from unitlist";
                      $result = $conn->query($sql);
                      while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row["unit_id"] . "\">" . $row["unit_name"] . "</option>";
                      }
                      mysqli_close($conn);
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Create Standard</button>     
          </fieldset>
        </form>
      <?php else:
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM standardlist, standardtypelist, unitlist WHERE standardlist.std_type = standardtypelist.std_tid AND standardlist.std_unit = unitlist.unit_id";
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
      ?>
      <?php endif ?>
    </div>
  </body>
</html>