<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $hari = $_POST['hari'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $id_mapel = $_POST['mapel'];
    $id_kelas = $_POST['kelas'];
    $sql = "INSERT INTO jadwal (hari, waktu_mulai, waktu_selesai,id_mapel,id_kelas) VALUES('$hari', '$waktu_mulai', '$waktu_selesai', '$id_mapel', '$id_kelas')";
    $result = $conn->query($sql);
    if($result){
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  

  $conn->close();
?>