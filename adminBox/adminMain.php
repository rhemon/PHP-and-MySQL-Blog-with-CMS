<?php session_start() ?>
<?php include("../includes/functions.php"); ?>
<?php signOut() ?>
<?php checkLogIn() ?>
<?php include("../includes/layouts/header.php"); ?>
<div class="row">
  <div class="jumbotron">
   <form action="adminMain.php" method="post">
    <input  class="btn btn-primary btn-md pull-right" type="submit" name="signOut" value="Sign Out" /><br/><br/>
    <a href="../" class="btn btn-info btn-md pull-right">Blog</a>
    </form>
    <h3>PHP Blog Admin : <?php echo " ' " . $_SESSION['uname'] . " ' Logged In"; ?></h3>
  </div>
  <div class="row" id="adminOptions">
    <ul class="nav nav-pills nav-stacked">
      <li><a href="manageAdmins.php">Manage Admins</a></li>
      <li><a href="manageContent.php">Manage Content</a></li>
    </ul>
  </div>
</div>
<?php include("../includes/layouts/htmlEnd.php"); ?>