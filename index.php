<?php session_start();
if(!isset($_SESSION["logged_in"])) {
  $_SESSION["logged_in"] = false;
}?>

<!DOCTYPE html>

<?php $_SESSION["last_page"] = "index.php"; ?>
<?php include("db_header.php"); ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>Nextek - Index</title>
</head>
<body>
  <div class="container">
  
  <?php
    include("banner.php");
    $conn = new mysqli($servername, $username, $password);
    if($conn->connect_error) {
      die("Connection Failed");
    }
    mysqli_close($conn);
  ?>

  <form method="get" action="part_entry.php">
    <label for="entry">Search for a Part: </label>
    <select name="entry">
      <?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT eid from partdata";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row["eid"] . "\">" . $row["eid"] . "</option>";
          }
        }
        else {
          echo "No Parts to Search for";
        }
        mysqli_close($conn);
      ?>
    </select>
    <input type="submit" value="Select">
  </form>

  </br>

  <?php
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT * FROM partdata";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table><col width=250><col width=250><col width=250><col width=250><col width=250><col width=250>";
      echo "<tr><td><h5>Date:</h5></td><td><h5>Cal Tech:</h5></td><td><h5>Type:</h5></td><td><h5>ID:</h5></td><td><h5>Model:</h5></td><td><h5>Next Cal Date:</h5></td></tr>";
      while ($row = $result->fetch_assoc()) {
        $N_datetime = $row["date_time"];
        $timestamp = strtotime($N_datetime);
        $date = date('m/d/Y', $timestamp);
        $timestamp = strtotime($N_datetime . " + 365 day");
        $N_date = date('m/d/Y', $timestamp);
        echo "<tr><td>" . $date . "</td><td>" . $row["caltech"] . "</td><td>" . $row["parttype"] . "</td><td>"
          . $row["eid"] . "</td><td>" . $row["visasfound"] . "</td><td>" . $N_date . "</td></tr>";
      } 
    } else {
        echo "<h2>partdata has no data.</h2>";
    }
    echo "</table>";
    mysqli_close($conn);
  ?>
  </br></br></br>

  <?php if($_SESSION["logged_in"] == true): ?>
    <form method="post" action="create_part.php">
      <label for="parttype">Type: </label>
      <select name="parttype">
        <?php
          $conn = new mysqli($servername, $username, $password, $dbname);
          $sql = "SELECT Name from parttype";
          $result = $conn->query($sql);
          while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row["Name"] . "\">" . $row["Name"] . "</option>";
          }
          mysqli_close($conn);
        ?>
      </select>

      <label for="eid">EID: </label>
      <input type="textarea" name="eid"><br/>

      <label for="visfound">Visual As Found: </label>
      <input type="textarea" name="visfound">
      <label for="asfound">As Found Condition: </label>
      <input type="textarea" name="asfound">
      <label for="asleft">As Left Condition: </label>
      <input type="textarea" name="asleft"><br/>

      <input type="submit" value="Create Part">
    </form>
  </br></br>
  <form method="post" action="edit_standards.php">
    <input type="submit" value="Manage Standards">
  </form>
  <?php endif ?>
  </br></br>
  <form method="post" action="edit_caltech.php">
    <input type="submit" value="Manage Caltechs">
  </form>

</div>
</body>
