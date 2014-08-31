<?php session_start() ?>
<?php include("../includes/functions.php"); ?>
<?php signOut() ?>
<?php checkLogIn() ?>
<?php include("../includes/DB_CONNECTION.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php
$sql = "SELECT * FROM `blogAdmin`.`adminPost`;";
$result = mysqli_query($conn, $sql);
confirmQuery($result);
?>
<div class="row">
  <div class="jumbotron">
   <form action="adminMain.php" method="post">
    <input  class="btn btn-primary btn-md pull-right" type="submit" name="signOut" value="Sign Out" /><br/><br/>
    <ul class="nav nav-pills pull-right">
      <li> <a href="../" class="btn btn-info btn-md">Blog</a> </li>
      <li> <a href="./adminMain.php" class="btn btn-info btn-md">Management</a> </li> 
    </ul>
    </form>
    <h3>PHP Blog - Content Management - Admin : <?php echo " ' " . $_SESSION['uname'] . " ' Logged In"; ?></h3>
  </div>
</div>
<!-- Navigation --> 
<div class="row">
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    <ul class="nav nav-pills nav-stacked">
      <?php
      while($row = mysqli_fetch_assoc($result)): ?>
      <li><a href="manageContent.php?id=<?= $row['id']; ?>"><?= $row['title']; ?> </a>
      </li>
      <?php endwhile;?>
    </ul>
    <div><a href="manageContent.php?new=True" class="btn btn-info btn-md btn-block" /> Add Post </a> </div><br/>
  </div>
  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    <?php
      if (isset($_GET['id'])){ 
        $id = $_GET['id'];
        $sql = "SELECT * FROM `blogAdmin`.`adminPost` WHERE id='$id';";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result);
        $row = mysqli_fetch_assoc($result);
      ?>
      <form action="../includes/UPDATE_POST.php" method="post" role="form">
        <div class="form-group">
          <label for="id">Id</label>
          <input type="text" class="form-control" name="id" id="id" value="<?= $row['id']; ?>" readonly/>
        </div>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" id="title" value="<?= $row['title']; ?>" required/> 
        </div>
        <div class="form-group">
          <label for="post">Post</label>
          <textarea class="form-control"  name="post" id="post"><?= $row['post']; ?></textarea>
        </div>
        <div class="form-group">
          <labe for="date">Date </label>
          <input type="date" class="form-control" name="date" id="date" value"<?= $row['date']; ?>" />
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-warning btn-sm pull-right" name="submit" value="CHANGE" /><br/><br/>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-danger btn-sm pull-right" value="DELETE" />
        </div><br/><br/>
        <span class="help-block">
        <?php
          if (isset($_GET['msg'])){
            echo msgReader($_GET['msg']);
          }
        ?>
        </span> <br/>
      </form>
      
    <?php  } elseif (isset($_GET['new'])) {?>
    <form action="../includes/CREATE_POST.php" method="post" role="form">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" id="title" required/> 
        </div>
        <div class="form-group">
          <label for="post">Post</label>
          <textarea class="form-control" name="post" id="post" required></textarea>
        </div>
        <div class="form-group">
          <label for="date">Date </label>
          <input type="date" class="form-control" name="date" id="date" required/>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-success btn-sm pull-right" name="submit" value="Add" />
        </div>
        <br/><br/>
    </form>
    <?php 
    if (isset($_GET['msg'])){
        echo msgReader($_GET['msg']);
      }
    ?>
    <?php } else {
        echo "<h1>Welcome to Admin Box, Start Managing your content</h1>";
      }
    ?>
  </div>
</div>
<?php include("../includes/layouts/footer.php"); ?>
<?php include("../includes/layouts/htmlEnd.php"); ?>
<?php include("../includes/CONNECTION_CLOSE.php"); ?>