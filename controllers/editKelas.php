<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $id = $_REQUEST['id'];
    $kelas = $_POST['kelas'];
    $sql = "UPDATE kelas SET kelas='$kelas' WHERE id='$id'";
    $result = $conn->query($sql);
    if($result){
      header("Location: ../kelas.php?id=$id");
      exit();
    }
  }
  

  $conn->close();
?>