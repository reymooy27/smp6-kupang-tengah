<?php
  require './db.php';
  $conn = OpenCon();

  function tambahSiswa($conn){
    $nama = $_POST['nama'];
    $kelasId = $_POST['kelasId'];
    $sql = "INSERT INTO siswa (nama) VALUES('$nama', '$kelasId)";
    $result = $conn->query($sql);
  }



?>