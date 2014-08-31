<?php session_start() ?>
<?php include("../includes/functions.php"); ?>
<?php signOut() ?>
<?php checkLogIn() ?>
<?php include("../includes/DB_CONNECTION.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<form method="post" action="CHECK_ADD_NEW_ADMIN.php" role="form">
<div class="form-group">
    <label for="usrname">User Name</label>
    <input class="form-control" name="usrname" id="usrname" placeholder="User Name" />
  </div>

  <div class="form-group">
    <label for="npass">Password</label>
    <input type="password" class="form-control" name="npass" id="npass" placeholder="Enter password" />
  </div>
  
  <div class="form-group">
    <label for="cpass">Confirm Password</label>
    <input type="password" class="form-control" name="cpass" id="cpass" placeholder="Confirm password" />
  </div>

  <div class="form-group">
    <label for="apass">Admin Password</label>
    <input type="password" class="form-control" name="apass" id="apass" placeholder="Confrim the new user with admin's password" required />
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