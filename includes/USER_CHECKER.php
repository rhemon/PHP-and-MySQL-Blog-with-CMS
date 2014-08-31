<?php session_start() ?>
<?php ob_start() ?>
<?php include("./functions.php"); ?>
<?php include("./DB_CONNECTION.php"); ?>
<?php
$userGivenUsername = $_POST['usrName'];
$userGivenUserpass = $_POST['usrPass'];
?>
<?php
$sql = "SELECT * FROM `blogAdmin`.`adminUser` WHERE userName='$userGivenUsername';";
$result = mysqli_query($conn, $sql);
if (confirmQuery($result) == 'DONE') {
  $row = mysqli_fetch_assoc($result);
  if (!$row){
    $_SESSION['error'] = 'wun';
    mysqli_close($conn);
    header("Location: ../adminBox/index.php");
  } elseif ($row['userPass'] == $userGivenUserpass){
    mysqli_free_result($row);
    mysqli_free_result($result);
    mysqli_close($conn);
    $_SESSION['uname'] = $userGivenUsername;
    $_SESSION['loggedIn'] = 'True';
    header("Location: ../adminBox/adminMain.php");
  } else {
    $_SESSION['error'] = 'wpw';
    mysqli_close($conn);
    header("Location: ../adminBox/index.php");
  }
}
?>