<?php require './partial/header.php'?>
<?php 
  $conn = OpenCon();

  if(isset($_SESSION['role'])){
    if($_SESSION['role'] !== 'Admin'){
      header('Location: ./login.php');
      exit();
    }
  }


  $sql = "SELECT jadwal.*, kelas.kelas, mapel.nama_mapel FROM jadwal LEFT JOIN kelas ON jadwal.id_kelas = kelas.id LEFT JOIN mapel ON jadwal.id_mapel = mapel.id_mapel";
  $result = $conn->query($sql);
  $data = array(); // initialize an empty array to store the rows
  while ($row = $result->fetch_assoc()) {
      $data[] = $row; // append each row to the data array
  }

  $sqlMapel = "SELECT * FROM mapel";
  $resultMapel = $conn->query($sqlMapel);
  $mapel = $resultMapel->fetch_all(); 

  $sqlKelas = "SELECT * FROM kelas";
  $resultKelas = $conn->query($sqlKelas);
  $kelas = $resultKelas->fetch_all(); 
  
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
      <h1>Jadwal Pelajaran</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="profil-sekolah.php">Home</a></li>
          <li class="breadcrumb-item active">Jadwal Pelajaran</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="d-flex justify-content-between mb-3">
            <div>
              <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahJadwal">
                <i class="bi bi-plus"></i>
                Tambah Jadwal
              </button>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Jadwal Pelajaran</h5>
              <div class="table-responsive">
                <table class="table datatable" id="datatable">
                  <thead>
                    <tr class="table-secondary">
                      <th scope="col" class="text-center">No</th>
                      <th scope="col" class="text-center">Hari</th>
                      <th scope="col" class="text-center">Mata Pelajaran</th>
                      <th scope="col" class="text-center">Kelas</th>
                      <th scope="col" class="text-center">Waktu Mulai</th>
                      <th scope="col" class="text-center">Waktu Selesai</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $key=>$row):?>
                      <tr>
                        <td><?= $key + 1?></td>
                        <td><?= strtoupper($row['hari'])?></td>
                        <td><?= $row['nama_mapel']?></td>
                        <td><?= $row['kelas']?></td>
                        <td><?= $row['waktu_mulai']?></td>
                        <td><?= $row['waktu_mulai']?></td>
                        <td class="d-flex gap-3 justify-content-center align-items-center">
                          <button type="button" id="btn-edit-jadwal" class="btn btn-warning btn-sm" data-id="<?= $row['id_jadwal']?>" data-jadwal='{"id_jadwal":"<?=$row['id_jadwal']?>","hari":"<?=$row['hari']?>","waktu_mulai":"<?=$row['waktu_mulai']?>","waktu_selesai":"<?=$row['waktu_selesai']?>","id_mapel":"<?=$row['id_mapel']?>","id_kelas":"<?=$row['id_kelas']?>"}' data-bs-toggle="modal" data-bs-target="#editJadwal">
                            <i class="bi bi-pencil-square"></i>
                          </button>
                          <button type="button" id="btn-hapus-jadwal" class="btn btn-danger btn-sm" data-id="<?= $row['id_jadwal']?>" data-bs-toggle="modal" data-bs-target="#hapusJadwal">
                            <i class="bi bi-trash"></i>
                          </button>
                        </td>
                      </tr>
                    </div>
                      <?php endforeach?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


        </div>
      </div>
    </section>

    <div class="modal fade" id="tambahJadwal" tabindex="-1" aria-labelledby="tambahJadwalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tambahJadwalLabel">Tambah Jadwal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/tambahJadwal.php" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="hari" class="form-label">Hari</label>
              <select name="hari" id="" class="form-select" required>
                <option value="">Pilih Hari</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
              </select>
            </div>
            <div>
              <label for="mapel" class="form-label">Mata Pelajaran</label>
              <select name="mapel" id="" class="form-select" required>
                <option value="">Pilih Mata Pelajaran</option>
                <?php foreach($mapel as $row):?>
                <option value="<?=$row[0]?>"><?=$row[1]?></option>
                <?php endforeach?>
              </select>
            </div>
            <div>
              <label for="kelas" class="form-label">Kelas</label>
              <select name="kelas" id="" class="form-select" required>
                <option value="Pilih Kelas">Pilih Kelas</option>
                <?php foreach($kelas as $row):?>
                <option value="<?=$row[0]?>"><?=$row[1]?></option>
                <?php endforeach?>
              </select>
            </div>
            <div>
              <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
              <input type="time"name="waktu_mulai" class="form-control" required>
            </div>
            <div>
              <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
              <input type="time"name="waktu_selesai" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editJadwal" tabindex="-1" aria-labelledby="editJadwalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editJadwalLabel">Edit Jadwal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/editJadwal.php?id=" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
          <div>
            <label for="hari" class="form-label">Hari</label>
            <select name="hari" id="" class="form-select" required>
              <option value="">Pilih Hari</option>
              <option value="Senin">Senin</option>
              <option value="Selasa">Selasa</option>
              <option value="Rabu">Rabu</option>
              <option value="Kamis">Kamis</option>
              <option value="Jumat">Jumat</option>
              <option value="Sabtu">Sabtu</option>
            </select>
          </div>
          <div>
            <label for="mapel" class="form-label">Mata Pelajaran</label>
            <select name="mapel" id="" class="form-select" required>
              <option value="Pilih Mata Pelajaran">Pilih Mata Pelajaran</option>
              <?php foreach($mapel as $row):?>
              <option value="<?=$row[0]?>"><?=$row[1]?></option>
              <?php endforeach?>
            </select>
          </div>
          <div>
            <label for="kelas" class="form-label">Kelas</label>
            <select name="kelas" id="" class="form-select" required>
              <option value="">Pilih Kelas</option>
              <?php foreach($kelas as $row):?>
              <option value="<?=$row[0]?>"><?=$row[1]?></option>
              <?php endforeach?>
            </select>
          </div>
          <div>
            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
            <input type="time"name="waktu_mulai" class="form-control" required>
          </div>
          <div>
            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
            <input type="time"name="waktu_selesai" class="form-control" required>
          </div>
            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="hapusJadwal" tabindex="-1" aria-labelledby="hapusJadwalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Anda yakin ingin menghapus mata pelajaran ini ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a class="btn btn-danger" href="./controllers/hapusJadwal.php?id=">Hapus Jadwal</a>
          </div>
        </div>
      </div>
    </div>

  </main>

<?php require './partial/footer.php'?>