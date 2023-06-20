<?php
  include './partial/header.php';


  if(isset($_SESSION['role'])){
    if($_SESSION['role'] !== 'Guru'){
      header('Location: ./login.php');
      exit();
    }
  }

  $id_guru = $user['id_guru'];

  $queryGuru = "SELECT guru.nama_guru, mapel.id_mapel, mapel.nama_mapel FROM guru LEFT JOIN mapel ON mapel.id_mapel = guru.id_mapel WHERE id_guru = $id_guru";
  $resultGuru = $conn->query($queryGuru);
  $guru = $resultGuru->fetch_all();

  $queryKelas = "SELECT kelas.* FROM kelas";
  $resultKelas = $conn->query($queryKelas);
  $kelas = $resultKelas->fetch_all();

  $id_kelas = $_GET['id'] ?? $kelas[0][0];

  $id_mapel = $guru[0][1];

  $sql = "SELECT siswa.nama, siswa.id_siswa AS idSiswa, kelas.id AS id_kelas, kelas.kelas, nilai.* FROM siswa
  LEFT JOIN kelas ON kelas.id = siswa.kelasId
  LEFT JOIN nilai ON nilai.id_mapel = $id_mapel AND nilai.id_siswa = siswa.id_siswa
  WHERE kelas.id = $id_kelas
  ";

  $result = $conn->query($sql); 
  $data = array();
  while ($row = $result->fetch_assoc()) {
      $data[] = $row; 
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
      <h1>Mata Pelajaran</h1>
      <h1>
        <b><?= $guru[0][2]?></b>
      </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Nilai Mata Pelajaran</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="d-flex justify-content-end align-items-center gap-3 mb-2">
            <span>Pilih Kelas :</span>
            <select id="kelasSelector" class="form-select w-25 ">
              <?php foreach($kelas as $row):?>
                <option value="<?= $row[0]?>" <?php if($row[0] == $id_kelas) echo "selected"?> ><?= $row[1]?></option>
              <?php endforeach?>
            </select>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Nilai</h5>
              <div class="table-responsive">
                <table class="table datatable" id="datatable">
                  <thead>
                    <tr class="table-secondary">
                      <th scope="col" class="text-center">Nama</th>
                      <th scope="col" class="text-center">Nilai</th>
                      <th scope="col" class="text-center">Ulangan</th>
                      <th scope="col" class="text-center">UTS</th>
                      <th scope="col" class="text-center">UAS</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $key=>$row):?>
                      <tr>
                        <td><?= $row['nama']?></td>
                        <td><?= $row['nilai']?></td>
                        <td><?= $row['ulangan']?></td>
                        <td><?= $row['uts']?></td>
                        <td><?= $row['uas']?></td>
                        <td>
                          <?php if($row['approved'] !== '1'):?>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                            id="btn-edit-nilai"
                            data-bs-target="#editNilai"
                            data-id="<?= $row['id_nilai']?>" 
                            data-nilai='{"id_nilai":"<?=$row['id_nilai']?>","idSiswa":"<?=$row['idSiswa']?>","id_mapel":"<?=$id_mapel?>","nilai":"<?=$row['nilai']?>","ulangan":"<?=$row['ulangan']?>","uts":"<?=$row['uts']?>","uas":"<?=$row['uas']?>"}'
                            >
                            <i class="bi bi-pencil-square"></i>
                          </button>
                          <?php else:?>
                            <span class="badge text-bg-success rounded-pill">Approved</span>
                          <?php endif?>
                        </td>
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

    <div class="modal fade" id="editNilai" tabindex="-1" aria-labelledby="editNilaiLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editNilaiLabel">Edit Nilai</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="../controllers/editNilai.php?id=" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="nilai" class="form-label">Nilai</label>
              <input type="number" value="" autofocus name="nilai" class="form-control">
            </div>
            <div>
              <label for="ulangan" class="form-label">Ulangan</label>
              <input type="number" value="" autofocus name="ulangan" class="form-control">
            </div>
            <div>
              <label for="uts" class="form-label">UTS</label>
              <input type="number" value="" autofocus name="uts" class="form-control">
            </div>
            <div>
              <label for="uas" class="form-label">UAS</label>
              <input type="number" value="" autofocus name="uas" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>

  </main>
  <?php include './partial/footer.php';?>
  