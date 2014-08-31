<?php include("includes/functions.php"); ?>
<?php include("includes/DB_CONNECTION.php"); ?>
<?php include("includes/layouts/header.php"); ?>
<?php
$sql = "SELECT * FROM `blogAdmin`.`adminPost`;";
$result = mysqli_query($conn, $sql);
confirmQuery($result);
?>
<!-- Header, Just With the Title and a Logo -->
<header class="row">
<div class="jumbotron">
  <h1>PHP Controlled Blog with CMS</h1>
</div>
</header>

<!-- The Main Part of the Body -->
<div class="row">
  <!-- The Navigation -->
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    <aside>
      <ul class="nav nav-pills nav-stacked">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
          <li><a href="index.php?id=<?= $row['id']; ?>"><?= $row['title']; ?> </a>
          </li>
        <?php endwhile;?>
      </ul>
    </aside>
  </div>

  <!-- Article -->
  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    <article>
    <?php
      if (isset($_GET['id'])){ 
        $id = $_GET['id'];
        $sql = "SELECT * FROM `blogAdmin`.`adminPost` WHERE id='$id';";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result);
        $row = mysqli_fetch_assoc($result);
    ?>
    <div class="jumbotron">
    <h3><?php echo $row['title']; ?></h3>
    <small class="pull-right">Written on : <?php echo date($row['date']); ?></small><br/><br/>
    <div>
      <p>
        <?php echo $row['post']; ?>
      </p>
    </div>
    </div>
    <?php } else { 
      header ("Location: ./index.php?id=1");
    } ?>
    </article>
  </div>
</div>
<?php include("includes/layouts/footer.php"); ?>
<?php include("includes/layouts/htmlEnd.php"); ?>
<?php include("includes/CONNECTION_CLOSE.php"); ?>