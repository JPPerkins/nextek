<div class="jumbotron page_header">
  <div class="row">
    <div class="col-sm">
      <a href="index.php">
        <h1>Nextek</h1>
      </a>
    </div>
    <div class="col-sm">
    </div>
    <div class="col-sm">
      <?php if($_SESSION["logged_in"] == false): ?>
        <form method="post" action="login.php">
          <label for="caltech">Cal Tech:</label>
          <select name="caltech">
          <?php
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "SELECT uname from caltech";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
              echo "<option value=\"" . $row["uname"] . "\">" . $row["uname"] . "</option>";
            }
            mysqli_close($conn);
          ?>
          </select>
          <input type="submit" value="Log In"></form>
      <?php else: ?>
        <p><span> <?php echo $_SESSION["username"] ?> </span> | <a href="logout.php">Log out</a></p>
      <?php endif; ?>
    </div>
  </div>
</div>
