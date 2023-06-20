<?php
  require '../db.php';
  $conn = OpenCon();
  session_start();

    $id = $_REQUEST['id'];
    $sql = "DELETE FROM siswa WHERE id_siswa='$id'";
    try {
      $result = $conn->query($sql);
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    } catch (\Throwable $th) {
      $_SESSION['error'] = 'Tidak bisa menghapus siswa';
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }

    $conn->close();
    
    
?>