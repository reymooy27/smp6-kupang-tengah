<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $nama_guru = $_POST['nama_guru'];
    $nama_guru = strtoupper($nama_guru);
    $nip = $_POST['nip'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];
    $no_telp = $_POST['no_telp'];
    $id_mapel = $_POST['mapel'];
    $id_kelas = $_POST['kelas'];

    $sql = "INSERT INTO guru (nama_guru, nip, tempat_lahir,tanggal_lahir,jenis_kelamin,agama,alamat,jabatan,no_telp,id_mapel, id_kelas) VALUES('$nama_guru','$nip','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$agama','$alamat','$jabatan','$no_telp','$id_mapel','$id_kelas')";    
    $result = $conn->query($sql);

    if($result){
      $insertedId = $conn->insert_id;
  
      $sqlUser = "INSERT INTO user (nama, username, password, id_guru, role) VALUES('$nama_guru','$nip','$nip','$insertedId','Guru')";
      $conn->query($sqlUser);
      header("Location: ../guru.php");
      exit();
    }
  }
  

  $conn->close();
?>