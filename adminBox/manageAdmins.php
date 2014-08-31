<?php session_start() ?>
<?php include("../includes/functions.php"); ?>
<?php signOut() ?>
<?php checkLogIn() ?>
<?php include("../includes/DB_CONNECTION.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php
$sql = "SELECT * FROM `blogAdmin`.`adminUser`;";
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
    <h3>PHP Blog - Admins Management - Admin : <?php echo " ' " . $_SESSION['uname'] . " ' Logged In"; ?></h3>
  </div>
</div>
<div class="row">
  <table class="table table-hover table-bordered">
    <tr>
      <th> User </th>
      <th colspan='2'>Management Options</th>
    </tr>
    
  <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?php echo $row['userName']; ?></td>
      <?php if ($row['userName'] == $_SESSION['uname']) { ?>
        <td><a href="../includes/EDIT_ADMIN.php?editId=<?php echo $row['id']; ?>">Edit</a></td> 
      <?php } ?>
      <?php if ($row['userName'] !== 'admin') { ?>
        <?php if ($_SESSION['uname'] == 'admin') { ?>
          <td><a href="../includes/REMOVE_ADMIN.php?deleteId=<?php echo $row['id']; ?>">Delete</a></td>
        <?php } elseif ($_SESSION['uname'] != $row['userName']) { ?>
          <td colspan=2></td>
        <?php } ?>
      <?php } elseif ($_SESSION['uname'] !== 'admin') { ?>
        <td colspan=2></td>
      <?php } ?>
    </tr>
  <?php endwhile; ?>
  </table>
  <?php if ($_SESSION['uname'] === 'admin')  { ?>
    <div class="row">
      <p class="text-center"> <a href="../includes/ADD_ADMIN.php" class="btn btn-default btn-sm"> Add Admin </a> </p>
    </div>
  <?php } ?>
  <div class="help-block text-center">
    <?php
    if (isset($_GET['msg'])) {
      echo msgReader($_GET['msg']);
    }
  ?>
  </div>
</div>
<?php include("../includes/layouts/footer.php"); ?>
<?php include("../includes/layouts/htmlEnd.php"); ?>
<?php include("../includes/CONNECTION_CLOSE.php"); ?>