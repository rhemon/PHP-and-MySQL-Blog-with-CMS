<?php session_start(); ob_start(); ?>
<?php 
  if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==='True'){
    header("Location: adminMain.php");
  }
?>
<?php include("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<div class="row">
  <div class="jumbotron">
    <h3> Adming - Sign In </h3>
    <form action="../includes/USER_CHECKER.php" method="post" role="form" id="adminInForm" class="form-horizontal">
      <div class="form-group">  
        <input type="text" class="form-control" name="usrName" id="usrName" placeholder="User Name" required /> 
      </div>
      
      <div class="form-group">  
        <input type="password" class="form-control" name="usrPass" id="usrPass" placeholder="Password" required />
      </div>
      
      <input type="submit"  class="btn btn-success btn-md pull-right" name="submit" value="Sing In" /><br/><br/>
      <div><a href="../" class="btn btn-info btn-md pull-right">Blog</a></div>
      <?php
        if (isset($_SESSION['error'])){
          $errorMsg = msgReader($_SESSION['error']);
        }
      ?>
      <span class="help-block text-warning"><?php echo $errorMsg ?></span>
    </form>
  </div>
</div>
<?php include("../includes/layouts/htmlEnd.php"); ?>

