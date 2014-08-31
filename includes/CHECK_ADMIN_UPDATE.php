<?php session_start() ?>
<?php include("../includes/functions.php"); ?>
<?php signOut() ?>
<?php checkLogIn() ?>
<?php include("../includes/DB_CONNECTION.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

<?php
$newUserName = checkUserName('EDIT_ADMIN', $conn);
$newPass = checkPasswordMatch('EDIT_ADMIN', $conn);
?>
<?php
$ID = $_POST['id'];
$sql = "SELECT * FROM `blogAdmin`.`adminUser` WHERE id='$ID';";
$result = mysqli_query($conn, $sql);
confirmQuery($result);
$row = mysqli_fetch_assoc($result);
$oldUserName = $row['userName'];
if (isset($_POST['opass'])){
  $oldPass = $_POST['opass'];
  if (!$newPass){
    $newPass = $oldPass;
  }
} else {
  header("Location: ./EDIT_ADMIN.php?msg=nopa&editId={$_POST['id']}");
  die("NO PASSWORD PROVIDED :(");
}
if ($oldPass == $row['userPass']) {
  if(mysqli_query($conn, "UPDATE `blogAdmin`.`adminUser` SET userName='$newUserName', userPass='$newPass' WHERE id='$ID';")) {
    if ($_SESSION['uname'] == $oldUserName) {
      $_POST['signOut'] = true;
      signOut();
    } else {
      header("Location: ../adminBox/manageAdmins.php");
    }
  } 
} else {
  header("Location: ./EDIT_ADMIN.php?msg=hnom&editId={$_POST['id']}");
  die("OLD PASSWORD DIDN'T MATCH :(");
}
?>

<?php include("../includes/layouts/footer.php"); ?>
<?php include("../includes/layouts/htmlEnd.php"); ?>
<?php include("../includes/CONNECTION_CLOSE.php"); ?>