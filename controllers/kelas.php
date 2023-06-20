<?php

  function getKelas($conn){

    $query = "SELECT * FROM kelas";
    $result = $conn->query($query);
    $data = $result->fetch_all();

    return $data;
  }

?>