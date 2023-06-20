<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $id = $_REQUEST['id'];
    $nama_guru = $_POST['nama_guru'];
    $nip = $_POST['nip'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];
    $no_telp = $_POST['no_telp'];
    $id_kelas = $_POST['kelas'];
    $id_mapel = $_POST['mapel'];
    $sql = "UPDATE guru 
    SET nama_guru='$nama_guru',
    nip='$nip',
    tempat_lahir='$tempat_lahir',
    tanggal_lahir='$tanggal_lahir',
    jenis_kelamin='$jenis_kelamin',
    agama='$agama',
    alamat='$alamat',
    jabatan='$jabatan',
    no_telp='$no_telp', 
    id_mapel = '$id_mapel', 
    id_kelas = '$id_kelas' 
    WHERE id_guru='$id'";

    $result = $conn->query($sql);
    if($result){
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  

  $conn->close();
?>