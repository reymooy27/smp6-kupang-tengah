<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $id = $_REQUEST['id'];
    $hari = $_POST['hari'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $id_mapel = $_POST['mapel'];
    $id_kelas = $_POST['kelas'];
    $sql = "UPDATE jadwal SET hari='$hari',waktu_mulai='$waktu_mulai',waktu_selesai='$waktu_selesai',id_mapel='$id_mapel',id_kelas='$id_kelas' WHERE id_jadwal='$id'";
    $result = $conn->query($sql);
    if($result){
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  

  $conn->close();
?>