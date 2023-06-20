<?php
  require '../db.php';
  $conn = OpenCon();
  session_start();

    $id = $_REQUEST['id'];
    $sql = "DELETE FROM user WHERE id='$id'";
    try {
      $result = $conn->query($sql);
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    } catch (\Throwable $th) {
      $_SESSION['error'] = 'Tidak bisa menghapus user';
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
    }

    $conn->close();
    
    
?>