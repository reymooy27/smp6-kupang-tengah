<?php
  require './db.php';

  $conn = OpenCon();
  session_start();

  $user;

  if(isset($_SESSION['user-id'])){
    $id = $_SESSION['user-id'];
    $query = "SELECT * FROM user WHERE id='$id'";
    $result = $conn->query($query);
    $user = mysqli_fetch_assoc($result);
  }else{
    header('Location: login.php');
    exit;
  }
  

  $conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - SMP 6</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/datatables/datatables.css" rel="stylesheet">
  
  

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="profil-sekolah.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block text-sm-center">SMP Negeri 6 Kupang Tengah</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block ps-2"><?=$user['username']?></span>
          </a><!-- End Profile Iamge Icon -->

        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="profil-sekolah.php">
          <i class="bi bi-grid"></i>
          <span>Profil Sekolah</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Informasi Akademik</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="kelas.php">
              <i class="bi bi-circle"></i><span>Kelas</span>
            </a>
          </li>
          <li>
            <a href="nilai.php">
              <i class="bi bi-circle"></i><span>Nilai</span>
            </a>
          </li>
          <li>
            <a href="guru.php">
              <i class="bi bi-circle"></i><span>Guru</span>
            </a>
          </li>
          <li>
            <a href="mata-pelajaran.php">
              <i class="bi bi-circle"></i><span>Mata Pelajaran</span>
            </a>
          </li>
          <li>
            <a href="jadwal.php">
              <i class="bi bi-circle"></i><span>Jadwal Pelajaran</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-heading">Akun</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="akun.php">
          <i class="bi bi-person"></i>
          <span>Akun</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="controllers/logout.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->