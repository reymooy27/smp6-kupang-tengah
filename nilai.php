<?php require './partial/header.php'?>

<?php if(isset($_SESSION['error'])):?>
    <div class="alert alert-danger" role="alert">
      <?= $_SESSION['error']; unset($_SESSION['error'])?>
    </div>
  <?php endif?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Nilai</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="profil-sekolah.php">Home</a></li>
          <li class="breadcrumb-item active">Nilai</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          
        </div>
      </div>
    </section>

<?php require './partial/footer.php'?>