<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $nama_mapel = $_POST['nama_mapel'];
    $sql = "INSERT INTO mapel (nama_mapel) VALUES('$nama_mapel')";
    $result = $conn->query($sql);
    if($result){
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  

  $conn->close();
?>