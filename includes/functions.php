<?php ob_start() ?>
<?php

function confirmConnection($conn){
  if (mysqli_error($conn)){
    die("Connection Error");
  }
}

function confirmQuery($result){
  if (!$result){
    die("Query Error");
  } else {
    return "DONE";
  }
}

function msgReader($msg){
  if ($msg == "wun"){
    $Message = "Wrong User Name";
  } elseif ($msg =="wpw") {
    $Message = "Wrong Password";
  } elseif ($msg == "qe"){
    $Message = "Update Failed";
  } elseif ($msg == "updated"){
    $Message = "Updated";
  } elseif ($msg == "dqe"){
    $Message = "Delete Query Failed";
  } elseif ($msg == "noun") {
    $Message = "You need to provide a user name";
  } elseif ($msg == "nom") {
    $Message = "Your new passwords doesn't match";
  } elseif ($msg == "nopa") {
    $Message = "You need to provide your old password";
  } elseif ($msg == "hnom") {
    $Message = "Your old password is incorrect. Please type in the right one.";
  } elseif ($msg == "prob") {
    $Message = "There was a problem.";
  } elseif ($msg == "uexist") {
    $Message = "The Username already exists.";
  } elseif ($msg == "anom") {
    $Message = "Admin Password incorrect.";
  } elseif ($msg == "delprob") {
    $Message = "There was a problem in deleting.";
  } else {
    $Message = "Failed";
  }
  return $Message;
}
function checkLogIn(){
  if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==='True'){
    
  } else {
    header("Location: /PHP - Blog with Admin/adminBox/index.php");
  }
}
function signOut(){
  if (isset($_POST['signOut'])){
    session_destroy();
    header("Location: /PHP - Blog with Admin/adminBox/index.php");
  }
}

function checkUserName($url, $conn) {
  $location = "./$url.php";
  
  if (isset($_POST['usrname'])) {
    
    // if (mysqli_ping()) {
    //   echo "CONNECTION OK!";
    // } else {
    //   echo "CONNECTION IS NOT WORKING!";
    // }
    $newUserName = $_POST['usrname'];
    if ($_POST['oldUserName'] !== $newUserName) { 
      $sql = "SELECT * FROM `blogAdmin`.`adminUser` WHERE userName='$newUserName'";
      $result = mysqli_query($conn, $sql);
      confirmQuery($result);
      $row = mysqli_fetch_assoc($result);
      if (!$row){
        return $newUserName;
      } else {
        $location .= "?msg=uexist";
        if ($_POST['id']){
          $location .= "&editId={$_POST['id']}";
        } 
        header ("Location: $location");
        die("USERNAME EXISTS ALREADY");
      }
    } else {
      return $newUserName;
    }
  } else {
    $location .= "?msg=noun";
    if ($_POST['id']){
      $location .= "&editId={$_POST['id']}";
    }
    header("Location: $location");
    die("NO USERNAME :(");
  }
}

function checkPasswordMatch($url, $conn) {
  $location = "./$url.php";
  if (isset($_POST['npass']) && isset($_POST['cpass'])){
    $npass = $_POST['npass'];
    $cpass = $_POST['cpass'];
    if ($npass == $cpass) {
      $newPass = $npass;
      return $newPass;
    } else {
      $location .= "?msg=nom";
      if ($_POST['id']){
        $location .= "&editId={$_POST['id']}";
      }
      header("Location: $location");
      die("NEW PASSWORD DOESN'T MATCH :(");
    } 
  }
}
?>