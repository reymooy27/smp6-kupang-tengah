<?php
  require '../db.php';
  $conn = OpenCon();
  session_start();

    $id = $_REQUEST['id'];
    $sql = "DELETE FROM guru WHERE id_guru='$id'";
    $sqlUser = "DELETE FROM user WHERE id_guru='$id'";
    try {
      $result = $conn->query($sql);
      $conn->query($sqlUser);
      header("Location: ../guru.php");
      exit();
    } catch (\Throwable $th) {
      $_SESSION['error'] = 'Tidak bisa menghapus guru';
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }

    $conn->close();
    
    
?>