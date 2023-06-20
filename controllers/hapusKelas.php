<?php
  require '../db.php';
  $conn = OpenCon();
  session_start();

    $id = $_REQUEST['id'];
    $sql = "DELETE FROM kelas WHERE id='$id'";
    try {
      $result = $conn->query($sql);
      header("Location: ../kelas.php");
      exit();
    } catch (\Throwable $th) {
      $_SESSION['error'] = 'Tidak bisa menghapus, data kelas tidak kosong';
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }

    $conn->close();
    
    
?>