<?php
  include './partial/header.php';


  if(isset($_SESSION['role'])){
    if($_SESSION['role'] !== 'Guru'){
      header('Location: ./login.php');
      exit();
    }
  }

  $idGuru = $user['id_guru'];

  $queryGuru= "SELECT * FROM guru LEFT JOIN kelas ON guru.id_kelas = kelas.id WHERE guru.id_guru = $idGuru";
  $resultGuru = $conn->query($queryGuru);
  $wakel = $resultGuru->fetch_all();
  // echo json_encode($wakel);
  $nama_kelas = $wakel[0][13];
  $id_kelas = $wakel[0][10];

  $sql = "SELECT * FROM siswa LEFT JOIN kelas ON kelas.id = '$id_kelas' WHERE siswa.kelasId = '$id_kelas'";
  $result = $conn->query($sql); 
  $data = array();
  while ($row = $result->fetch_assoc()) {
      $data[] = $row; 
  }
  $conn->close();
  // echo json_encode($wakel);

?>

        
  <?php if(isset($_SESSION['error'])):?>
    <div class="alert alert-danger" role="alert">
      <?= $_SESSION['error']; unset($_SESSION['error'])?>
    </div>
  <?php endif?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Selamat Datang <b><?= $wakel[0][1]?></b></h1>
      <h1>Kelas <b><?= $nama_kelas?></b></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Kelas Saya</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Siswa</h5>
              <div class="table-responsive">
                <table class="table datatable" id="datatable">
                  <thead>
                    <tr class="table-secondary">
                      <th scope="col" class="text-center">No</th>
                      <th scope="col" class="text-center">NIS</th>
                      <th scope="col" class="text-center">Nama</th>
                      <th scope="col" class="text-center">Tempat/Tanggal Lahir</th>
                      <th scope="col" class="text-center">Jenis Kelamin</th>
                      <th scope="col" class="text-center">Agama</th>
                      <th scope="col" class="text-center">Alamat</th>
                      <th scope="col" class="text-center">Nama Ayah</th>
                      <th scope="col" class="text-center">Nama Ibu</th>
                      <th scope="col" class="text-center">Pekerjaan Ayah</th>
                      <th scope="col" class="text-center">Pekerjaan Ibu</th>
                      <th scope="col" class="text-center">Tahun/Semester</th>
                      <th scope="col" class="text-center">No. Telp</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $key=>$row):?>
                      <tr>
                        <td><?= $key + 1?></td>
                        <td><?= $row['nis']?></td>
                        <td>
                          <a href="data-siswa.php?id=<?= $row['id_siswa']?>" class="icon-link icon-link-hover link-primary link-underline">
                            <?= strtoupper($row['nama'])?>
                          </a>
                        </td>
                        <td><?= $row['tempat_lahir'].', ' . $row['tanggal_lahir']?></td>
                        <td><?= $row['jenis_kelamin']?></td>
                        <td><?= $row['agama']?></td>
                        <td><?= $row['alamat']?></td>
                        <td><?= $row['nama_ayah']?></td>
                        <td><?= $row['nama_ibu']?></td>
                        <td><?= $row['pekerjaan_ayah']?></td>
                        <td><?= $row['pekerjaan_ibu']?></td>
                        <td><?= $row['thn_semester']?></td>
                        <td><?= $row['no_telp']?></td>
                      </tr>
                      <?php endforeach?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


        </div>
      </div>
    </section>

  </main>
  
  <?php include './partial/footer.php';?>