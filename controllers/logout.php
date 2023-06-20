<?php
  session_start();
  unset($_SESSION["user-id"]);
  unset($_SESSION["role"]);
  if($_SESSION['is-admin'] > 0){
    unset($_SESSION['is-admin']);
    header('Location: ../dashboard.php');
    exit();
  }else{
    header('Location: ../login.php');
    exit();
  }
?>