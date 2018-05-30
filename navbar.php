<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="index.php">Nextek</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation" style="">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav mr-auto">
        <li>
          <form method="get" action="part_entry.php">
            <select class="form-control" name="entry">
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
        </li>
        <li>
          <button class="btn btn-primary" type="submit">Search</button>
          </form>
        </li>
      </ul>

      <?php if($_SESSION["logged_in"] == false): ?>
        <table><col width=100>
          <tbody>
            <tr>
              <form class="form-inline my-2 my-lg-0" method="post" action="login.php">
                <td>
                <select class="form-control" name="username">
                  <?php
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    $sql = "SELECT username from userlist";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                      echo "<option value=\"" . $row["username"] . "\">" . $row["username"] . "</option>";
                    }
                    mysqli_close($conn);
                  ?>
                </select>
                </td>
                <td>
                  <button class="btn btn-secondary my-2 my-sm-0" type="submit">Log In</button>
                </td>
              </form>
            </tr>
          </tbody>
        </table>

      <?php else: ?>
        <table><col width=100>
          <tbody>
            <tr>
              <td>
                <div class="text-success">
                  <?php 
                    echo $_SESSION["username"] 
                  ?>
                </div>
              </td>
              <td>
                <form class="form-inline my-2 my-lg-0" action="logout.php">
                  <button class="btn btn-outline-danger" type="submit">Log Out</button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</nav>