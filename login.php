<?php
session_start();
if (isset($_POST["submit"])) {
  $user = $_POST['user'];
  $pass = $_POST['pass'];

  require_once 'config.php';
  $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  $query = mysqli_prepare($con, "SELECT * FROM login WHERE UserName=? AND password=?");
  mysqli_stmt_bind_param($query, "ss", $user, $pass);
  mysqli_stmt_execute($query);
  $result = mysqli_stmt_get_result($query);

  if ($row = mysqli_fetch_assoc($result)) {
    $dbusername = $row['UserName'];
    $dbpassword = $row['password'];
    $dpusertype = $row['Usertype'];
    $dbenggname = $row["EnggName"];

    if ($user == $dbusername && $pass == $dbpassword) {
      $_SESSION['sess_user'] = $user;
      $_SESSION['userType'] = $dpusertype;
      $_SESSION['enggname'] = $dbenggname;
      header("Location: ./ViewStatus.php");
      exit();
    }
  } 
  header("location: ./warn.php");
  exit();
}
?>
