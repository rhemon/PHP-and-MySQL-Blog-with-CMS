<?php session_start() ?>
<?php include("../includes/functions.php"); ?>
<?php signOut() ?>
<?php checkLogIn() ?>
<?php include("../includes/DB_CONNECTION.php"); ?>
<?php 
$newTitle = $_POST['title'];
$newPost = $_POST['post'];
$newDate = $_POST['date'];
$sql = "INSERT INTO `blogAdmin`.`adminPost` (`id`, `title`, `post`, `date`) VALUES (NULL, '$newTitle', '$newPost', '$newDate');";
if (mysqli_query($conn, $sql)) {
  header("Location: ../adminBox/manageContent.php");
} else {
  header("Location: ../adminBox/manageContent.php?new=True&msg=ae");
}
?>
<?php include("../includes/CONNECTION_CLOSE.php"); ?>