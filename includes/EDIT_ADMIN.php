<?php session_start() ?>
<?php include("../includes/functions.php"); ?>
<?php signOut() ?>
<?php checkLogIn() ?>
<?php include("../includes/DB_CONNECTION.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php
if (isset($_GET['editId'])){
  $id = $_GET['editId'];
  $sql="SELECT * FROM `blogAdmin`.`adminUser` WHERE id='$id';";
  $result = mysqli_query($conn, $sql);
  confirmQuery($result);
  $row = mysqli_fetch_assoc($result);
}
?>
<form method="post" action="CHECK_ADMIN_UPDATE.php" role="form">
  <div class="form-group">
    <label for="id">Id</label>
    <input class="form-control" name="id" id="id" value="<?php echo $row['id']; ?>" readonly/>
  </div>
  
  <div class="form-group">
    <label for="usrname">User Name</label>
    <input type="hidden" name="oldUserName" value="<?php echo $row['userName']; ?>" />
    <input class="form-control" name="usrname" id="usrname" value="<?php echo $row['userName']; ?>" <?php if ($row['userName'] == 'admin') {?>readonly<?php } ?> />
  </div>

  <div class="form-group">
    <label for="npass">New Password</label>
    <input type="password" class="form-control" name="npass" id="npass" placeholder="Enter your new password" />
  </div>
  
  <div class="form-group">
    <label for="cpass">Confirm Password</label>
    <input type="password" class="form-control" name="cpass" id="cpass" placeholder="Confirm your new password" />
  </div>

  <div class="form-group">
    <label for="opass">Old Password</label>
    <input type="password" class="form-control" name="opass" id="opass" placeholder="Confrim your change with Old Password" required />
  </div>
  <div class="help-block">
  <?php
    if (isset($_GET['msg'])){
      echo msgReader($_GET['msg']);
    }
  ?>
  </div>
  <input type="submit" name="submit" value="submit"/>
</form>
<?php include("../includes/layouts/footer.php"); ?>
<?php include("../includes/layouts/htmlEnd.php"); ?>
<?php include("../includes/CONNECTION_CLOSE.php"); ?>