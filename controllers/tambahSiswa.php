<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $nama = strtoupper($nama);
    $kelasId = $_REQUEST['id'];
    $nis = $_POST['nis'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $nama_ayah = $_POST['nama_ayah'];
    $nama_ibu = $_POST['nama_ibu'];
    $pekerjaan_ayah = $_POST['pekerjaan_ayah'];
    $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
    $thn_semester = $_POST['thn_semester'];
    $no_telp = $_POST['no_telp'];
    $sql = "INSERT IGNORE INTO siswa (nama,nis,tempat_lahir,tanggal_lahir,jenis_kelamin,agama,alamat,nama_ayah,nama_ibu,pekerjaan_ayah,pekerjaan_ibu,thn_semester,no_telp,kelasId) VALUES('$nama', '$nis','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$agama','$alamat','$nama_ayah','$nama_ibu','$pekerjaan_ayah','$pekerjaan_ibu','$thn_semester','$no_telp','$kelasId')";
    $result = $conn->query($sql);
    if($result){
      header("Location: ../kelas.php?id=$kelasId");
      exit();
    }
  }
  

  $conn->close();
?>