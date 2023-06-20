<?php
  require '../db.php';
  $conn = OpenCon();

  if(isset($_POST['submit'])){
    $kelas = $_POST['kelas'];
    $sql = "INSERT INTO kelas (kelas) VALUES('$kelas')";
    $result = $conn->query($sql);
    if($result){
      $new_id = mysqli_insert_id($conn);
      header("Location: ../kelas.php?id=$new_id");
      exit();
    }
  }
  

  $conn->close();
?>