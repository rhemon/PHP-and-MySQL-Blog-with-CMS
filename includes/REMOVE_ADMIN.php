<?php session_start() ?>
<?php include("../includes/functions.php"); ?>
<?php signOut() ?>
<?php checkLogIn() ?>
<?php include("../includes/DB_CONNECTION.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php
if (isset($_GET['deleteId'])){
  $DELETE_ID = $_GET['deleteId'];
}
if ($DELETE_ID){
  $sql = "DELETE FROM `blogAdmin`.`adminUser` WHERE id='$DELETE_ID'";
  $result = mysqli_query($conn, $sql);
  if (confirmQuery($result)) {
    header("Location: ../adminBox/manageAdmins.php");
  }
} else {
  header("Location: ../adminBox/manageAdmins.php?msg=delprob");
}
?>
<?php include("../includes/layouts/footer.php"); ?>
<?php include("../includes/layouts/htmlEnd.php"); ?>
<?php include("../includes/CONNECTION_CLOSE.php"); ?>