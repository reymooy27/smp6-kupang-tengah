<?php
  require '../db.php';
  session_start();
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$username){
      $_SESSION['login-error'] = 'Username harus diisi';
    }elseif(!$password){
      $_SESSION['login-error'] = 'Password harus diisi';
    }else{
      $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
      $success;
      $fetch_user = $conn->query($query);
      if (mysqli_num_rows($fetch_user) == 1){
        $user = mysqli_fetch_assoc($fetch_user);
        $_SESSION['user-id'] = $user['id'];
        $_SESSION['role'] = 'Guru';
        header('Location: ../guru/dashboard.php');
        
        
      }else{
        $_SESSION['login-error'] = 'User not found';
      }
    }

    if(isset($_SESSION['login-error'])){
      $_SESSION['login-data'] = $_POST;
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }else{
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
  }

  $conn->close();
?>