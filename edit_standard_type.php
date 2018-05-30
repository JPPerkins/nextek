<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <?php 
    $_SESSION["last_page"] = "edit_standard_type.php?tid=" . $_GET["tid"];
    include("db_header.php"); 
  ?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo "<title>Nextek - Standard Type " . $_GET["tid"] . "</title"; ?>
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
        $sql = "SELECT * FROM standardtypelist WHERE std_tid = " . $_GET['tid'];
        $result = $conn->query($sql);
        mysqli_close($conn);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          echo "<br><h2>" . $row["std_type"] . "</h2><br>";
          echo "<title>" . $row["std_type"] . "</title>"; 

          echo "<table class='table table-hover'><thead><tr>
            <th scope=col>Type</th>
            <th scope=col>Description</th>
            <th scope=col>Cal Cycle</th>
            <th scope=col>Location</th>
            <th scope=col>Last Cal</th>
            <th scope=col>Next Cal</th></tr></thead>";

          $dateTime = $row["std_last_cal"];
          $dateString = strtotime($dateTime);
          $lastCalDate = date('m/Y', $dateString);
          $lastCalMonth = date('m', $dateString);
          $lastCalYear = date('Y', $dateString);
          $dateString = strtotime($dateTime . " + " . $row["std_cal_cycle"] . " years");
          $nextCalDate = date('m/Y', $dateString);

          echo "<tr><th scope=row>" . $row["std_type"] . "</th><td>" . $row["std_desc"] . "</td><td>" . 
            $row["std_cal_cycle"]  . " Years</td><td>" . $row["std_loc"] . "</td><td>" . $lastCalDate . 
            "</td><td>" . $nextCalDate . "</td></tr></table>";
        } else {
            echo "<br><h3>No standard type data found for tid " . $_GET['tid'] . ".</h3><br>";
        }

      ?>
      </br></br></br>
      

      <?php if($_SESSION["logged_in"] == true): ?>
        <form method="post" action="modify_standard_type.php">
            <fieldset>
              <div class="row">
                <?php 
                  echo "<input type='hidden' name='stdTypeID' value='" . $row["std_tid"] . "'>";
                ?>
                <div class="col-lg-2">
                  <div class="form-group">
                    <?php 
                      echo "<input type='text' class='form-control' name='stdTypeListType' value='" . $row["std_type"] . "'>";
                    ?>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <?php 
                      echo "<input type='text' class='form-control' name='stdTypeListDesc' value='" . $row["std_desc"] . "'>";
                    ?>
                  </div>
                </div>
                <div class="col-lg-1">
                  <div class="form-group">
                    <?php 
                      echo "<input type='text' class='form-control' name='stdTypeListCC' value='" . $row["std_cal_cycle"] . "'>";
                    ?>
                    <small id="calcycleHelp" class="form-text">In Years</small>
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group">
                    <?php 
                      echo "<input type='text' class='form-control' name='stdTypeListLoc' value='" . $row["std_loc"] . "'>";
                    ?>
                  </div>
                </div>
                <div class="col-lg-1">
                  <div class="form-group">
                    <?php 
                      echo "<input type='text' class='form-control' name='stdTypeListLastCalM' value='" . $lastCalMonth . "'>";
                    ?>
                  </div>
                </div>
                <div class="col-lg-2">
                  <div class="form-group">
                    <?php 
                      echo "<input type='text' class='form-control' name='stdTypeListLastCalY' value='" . $lastCalYear . "'>";
                    ?>
                  </div>
                </div>
              </div> <br>
              <div class="row">
                <div class="col-lg-1"></div> 
                <button type="submit" class="btn btn-info">Save Edits</button>
                <div class="col-lg-8"></div>
                <div class="col-lg-2">
                  <?php 
                    echo "<a class='btn btn-outline-danger' href=\"remove_standard_type.php?tid=" . $_GET['tid'] . "\">Delete</a>";
                  ?>
                </div>
              </div>     
            </fieldset>
          </form>
        </br></br></br>
      <?php endif ?>

      <a class="btn btn-primary" href="standard_types.php">Back to Standard Types</a>

    </div>
  </body>
</html>