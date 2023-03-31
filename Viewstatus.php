<?php
session_start();

if (!isset($_SESSION['sess_user'])) {
  header("location: ./login.php");
  exit();
}

$userType = $_SESSION['userType'];
$enggname = $_SESSION['enggname'];

// Retrieve status data from database based on user type and engineer name
require_once 'config.php';
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($userType == 'admin') {
  $query = mysqli_query($con, "SELECT * FROM status");
} else {
  $query = mysqli_prepare($con, "SELECT * FROM status WHERE EnggName=?");
  mysqli_stmt_bind_param($query, "s", $enggname);
  mysqli_stmt_execute($query);
  $result = mysqli_stmt_get_result($query);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Status</title>
</head>
<body>
  <h1>Status</h1>
  <?php if ($userType == 'admin') { ?>
    <table>
      <thead>
        <tr>
          <th>Engineer Name</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
          <tr>
            <td><?= $row['EnggName'] ?></td>
            <td><?= $row['Status'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { 
    if (mysqli_num_rows($result) == 0) { ?>
      <p>No status found for <?= $enggname ?></p>
    <?php } else { ?>
      <table>
        <thead>
          <tr>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?= $row['Status'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } 
  } ?>
</body>
</html>
