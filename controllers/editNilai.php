<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $id_nilai = $_REQUEST['id_nilai'];
    $id_siswa = $_REQUEST['id_siswa'];
    $id_mapel = $_REQUEST['id_mapel'];
    $nilai = $_POST['nilai'];
    $ulangan = $_POST['ulangan'];
    $uts = $_POST['uts'];
    $uas = $_POST['uas'];
    
    $sql = "INSERT INTO nilai (id_nilai, nilai, ulangan,uts, uas, id_siswa,id_mapel) VALUES('$id_nilai','$nilai','$ulangan','$uts','$uas','$id_siswa','$id_mapel') ON DUPLICATE KEY UPDATE    
    nilai='$nilai',ulangan='$ulangan',uts='$uts',uas='$uas'";
    $result = $conn->query($sql);
    if($result){
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  

  $conn->close();
?>