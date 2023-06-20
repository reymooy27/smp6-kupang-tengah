<?php
  include './partial/header.php';
  $conn = OpenCon();

  if(isset($_SESSION['role'])){
    if($_SESSION['role'] !== 'Guru'){
      header('Location: ./login.php');
      exit();
    }
  }

  $id_user = $_SESSION['user-id'];

  $sql = "SELECT * FROM user WHERE id = $id_user";
  $result = $conn->query($sql);
  $data = array(); // initialize an empty array to store the rows
  while ($row = $result->fetch_assoc()) {
      $data[] = $row; // append each row to the data array
  }
  $conn->close();
  // echo json_encode($data);

?>

        
  <?php if(isset($_SESSION['error'])):?>
    <div class="alert alert-danger" role="alert">
      <?= $_SESSION['error']; unset($_SESSION['error'])?>
    </div>
  <?php endif?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Akun Saya</b></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Akun</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2><?=$data[0]['nama']?></h2>
              <h3>Guru</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->

                <div class="pt-3" id="profile-change-password">
                  <h1 class="card-title">Pengaturan Akun</h1>
                  <form>
                    <div class="row mb-3">
                      <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nama" value="<?=$data[0]['nama']?>" type="text" class="form-control" id="nama">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="username" value="<?=$data[0]['username']?>" type="text" class="form-control" id="username">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" value="<?=$data[0]['password']?>" type="password" class="form-control" id="password">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
  
  <?php include './partial/footer.php';?>