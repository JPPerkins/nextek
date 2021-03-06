<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <?php $_SESSION["last_page"] = "units.php"; ?>
  <?php include("db_header.php"); ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nextek - Types & Units</title>
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
      <h2>Unit Types</h2>
      <br>
      <?php if($_SESSION["logged_in"] == true):
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM unitlist";
        $result = $conn->query($sql);
        mysqli_close($conn);

        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>Unit</th>
            <th scope=col>Edit</th>
            <th scope=col>Remove</th></tr></thead>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr><th scope=row><form method='post' action='modify_unit.php?unit_id=" . $row['unit_id'] . "'>";
            echo "<input type='text' class='form-control' name='unit_name' value='" . $row["unit_name"] . "'></th>";
            echo "<td><button class='btn btn-info' type='submit'>Edit</button></form></td>";
            echo "<td><a class='btn btn-danger ' href=\"remove_unit.php?unit_id=" . $row['unit_id'] . "\">Remove</a></td></tr>";
          }
          echo "</table>";
        } else {
            echo "<h3>No unit data found.</h3>";
        } ?>
        <form method="post" action="add_unit.php">
          <fieldset>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="col-form-label" for="unit_name">Unit</label>
                  <input type="text" class="form-control" name="unit_name" placeholder="Unit">
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Create Unit</button>     
          </fieldset>
        </form>
      <?php else: 
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM unitlist";
        $result = $conn->query($sql);
        mysqli_close($conn);

        if ($result->num_rows > 0) {
          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>Unit</th></tr></thead>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr><th scope=row>" . $row["unit_name"] . "</th></tr>";
          }
          echo "</table>";
        } else {
            echo "<h3>No unit data found.</h3>";
        } ?>
      <?php endif ?>
    </div>
  </body>
</html>