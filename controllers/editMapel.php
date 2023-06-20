<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $id = $_REQUEST['id'];
    $nama_mapel = $_POST['nama_mapel'];
    
    $sql = "UPDATE mapel SET nama_mapel='$nama_mapel' WHERE id_mapel='$id'";
    $result = $conn->query($sql);
    if($result){
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  

  $conn->close();
?>