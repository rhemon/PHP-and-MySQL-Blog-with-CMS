<?php session_start() ?>
<?php include("../includes/functions.php"); ?>
<?php signOut() ?>
<?php checkLogIn() ?>
<?php include("../includes/DB_CONNECTION.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

<?php 
$adminUNAME = checkUserName('ADD_ADMIN', $conn);
$adminPass = checkPasswordMatch('ADD_ADMIN', $conn);
?>
<?php
$adminPassword = $_POST['apass'];
$sql = "SELECT * FROM `blogAdmin`.`adminUser` WHERE userName='admin'";
$result = mysqli_query($conn, $sql);
confirmQuery($result);
$row = mysqli_fetch_assoc($result);
if ($adminPassword === $row['userPass']){
  $sql = "INSERT INTO `blogAdmin`.`adminUser` (`id`, `userName`, `userPass`) VALUES (NULL, '$adminUNAME', '$adminPass')";
  echo "I AM HERE";
  $result = mysqli_query($conn, $sql);
  if (confirmQuery($result)){
    header("Location: ../adminBox/manageAdmins.php");
    die("Added");
  } else {
    header("Location: ./ADD_ADMIN.php?msg=prob");
    die("There is a problem");
  }
} else {
  header("Location: ./ADD_ADMIN.php?msg=anom");
  die("Password doesn't match.");
}
?>
<?php include("../includes/layouts/footer.php"); ?>
<?php include("../includes/layouts/htmlEnd.php"); ?>
<?php include("../includes/CONNECTION_CLOSE.php"); ?>