<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "INSERT INTO user (nama,username,password,role) VALUES('$nama','$username','$password','Admin')";
    $result = $conn->query($sql);
    if($result){
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  

  $conn->close();
?>