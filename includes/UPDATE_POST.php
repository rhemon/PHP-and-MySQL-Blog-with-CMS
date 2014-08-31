<?php session_start() ?>
<?php include("../includes/functions.php"); ?>
<?php signOut() ?>
<?php checkLogIn() ?>
<?php include("../includes/DB_CONNECTION.php"); ?>
<?php
$oldId = $_POST['id'];
$newTitle = $_POST['title'];
$newPost = $_POST['post'];
$newDate = $_POST['date'];
$sql = "SELECT * FROM `blogAdmin`.`adminPost` WHERE id='$oldId';";
$result = mysqli_query($conn, $sql);
if (confirmQuery($result)=='DONE') {
  $row = mysqli_fetch_assoc($result);
  if (isset($row) && $_POST['submit']=='CHANGE') {
    $sql = "UPDATE `blogAdmin`.`adminPost` SET title='$newTitle', post='$newPost', date='$newDate' WHERE id='$oldId';";
    if (mysqli_query($conn, $sql)) {
      header("Location: ../adminBox/manageContent.php?id=$oldId&msg=updated");
    } else {
      header("Location: ../adminBox/manageContent.php?id=$oldId&msg=qe");
    }
  } elseif(isset($row) && $_POST['submit']=='DELETE'){
   $sql = "DELETE FROM `blogAdmin`.`adminPost` WHERE id='$oldId';";
   if (mysqli_query($conn, $sql)) {
      header("Location: ../adminBox/manageContent.php");
    } else {
      header("Location: ../adminBox/manageContent.php?id=1&msg=dqe");
    }
  }
}
?>
<?php include("../includes/CONNECTION_CLOSE.php"); ?>
