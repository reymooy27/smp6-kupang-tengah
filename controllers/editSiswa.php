<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $id = $_REQUEST['id'];
    $nama = $_POST['nama'];
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
    $sql = "UPDATE siswa SET nama='$nama',nis='$nis',tempat_lahir='$tempat_lahir',tanggal_lahir='$tanggal_lahir',jenis_kelamin='$jenis_kelamin',agama='$agama',alamat='$alamat',nama_ayah='$nama_ayah',nama_ibu='$nama_ibu',pekerjaan_ayah='$pekerjaan_ayah',pekerjaan_ibu='$pekerjaan_ibu',thn_semester='$thn_semester',no_telp='$no_telp' WHERE id_siswa='$id'";
    $result = $conn->query($sql);
    if($result){
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }
  }
  

  $conn->close();
?>