<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $id = $_REQUEST['id'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    
    $sql = "UPDATE user SET username='$username',nama='$nama',password='$password' WHERE id='$id'";
    $result = $conn->query($sql);
    if($result){
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  

  $conn->close();
?>