<?php require './partial/header.php'?>

<?php 
  $conn = OpenCon();

  if(isset($_SESSION['role'])){
    if($_SESSION['role'] !== 'Admin'){
      header('Location: ./login.php');
      exit();
    }
  }


  $sql = "SELECT * FROM guru LEFT JOIN mapel ON mapel.id_mapel = guru.id_mapel LEFT JOIN kelas ON kelas.id = guru.id_kelas";
  $result = $conn->query($sql);
  $data = array(); // initialize an empty array to store the rows
  while ($row = $result->fetch_assoc()) {
      $data[] = $row; // append each row to the data array
  }

  $sqlMapel = "SELECT * FROM mapel";
  $resultMapel = $conn->query($sqlMapel);
  $mapel = $resultMapel->fetch_all(); 

  $sqlKelas = "SELECT kelas.id as id_kelas, kelas.kelas FROM kelas";
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
      <h1>Guru</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="profil-sekolah.php">Home</a></li>
          <li class="breadcrumb-item active">Guru</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="d-flex justify-content-between mb-3">
            <div>
              <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahGuru">
                <i class="bi bi-plus"></i>
                Tambah Guru
              </button>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Guru</h5>
              <div class="table-responsive">
                <table class="table datatable" id="datatable">
                  <thead>
                    <tr class="table-secondary">
                      <th scope="col" class="text-center">No</th>
                      <th scope="col" class="text-center">Nama</th>
                      <th scope="col" class="text-center">NIP</th>
                      <th scope="col" class="text-center">Mata Pelajaran</th>
                      <th scope="col" class="text-center">Wali Kelas</th>
                      <th scope="col" class="text-center">Tempat/Tanggal Lahir</th>
                      <th scope="col" class="text-center">Jenis Kelamin</th>
                      <th scope="col" class="text-center">Agama</th>
                      <th scope="col" class="text-center">Alamat</th>
                      <th scope="col" class="text-center">Jabatan</th>
                      <th scope="col" class="text-center">No. Telp</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $key=>$row):?>
                      <tr>
                        <td><?= $key + 1?></td>
                        <td><?= strtoupper($row['nama_guru'])?></td>
                        <td><?= $row['nip']?></td>
                        <td><?= $row['nama_mapel']?></td>
                        <td><?= $row['kelas']?></td>
                        <td><?= $row['tempat_lahir'].', ' . $row['tanggal_lahir']?></td>
                        <td><?= $row['jenis_kelamin']?></td>
                        <td><?= $row['agama']?></td>
                        <td><?= $row['alamat']?></td>
                        <td><?= $row['jabatan']?></td>
                        <td><?= $row['no_telp']?></td>
                        <td class="d-flex gap-3">
                          <button type="button" id="btn-edit-guru" class="btn btn-warning btn-sm" data-id="<?= $row['id_guru']?>" data-guru='{"id_guru":"<?=$row['id_guru']?>","nama_guru":"<?=$row['nama_guru']?>","nip":"<?=$row['nip']?>","tempat_lahir":"<?=$row['tempat_lahir']?>","tanggal_lahir":"<?=$row['tanggal_lahir']?>","jenis_kelamin":"<?=$row['jenis_kelamin']?>","agama":"<?=$row['agama']?>","alamat":"<?=$row['alamat']?>","jabatan":"<?=$row['jabatan']?>","no_telp":"<?=$row['no_telp']?>","id_mapel":"<?=$row['id_mapel']?>","id_kelas":"<?=$row['id_kelas']?>"}' data-bs-toggle="modal" data-bs-target="#editGuru">
                            <i class="bi bi-pencil-square"></i>
                          </button>
                          <button type="button" id="btn-hapus-guru" class="btn btn-danger btn-sm" data-id="<?= $row['id_guru']?>" data-bs-toggle="modal" data-bs-target="#hapusGuru">
                            <i class="bi bi-trash"></i>
                          </button>
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

    <!-- Modal -->
    <div class="modal fade" id="tambahGuru" tabindex="-1" aria-labelledby="tambahGuruLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tambahGuruLabel">Tambah Guru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/tambahGuru.php" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="nama_guru" class="form-label">Nama Guru</label>
              <input type="text" placeholder="Nama Guru" autofocus name="nama_guru" required class="form-control">
            </div>
            <div>
              <label for="nip" class="form-label">NIP</label>
              <input type="text" pattern="\d*" maxlength="18" placeholder="NIP Guru" autofocus name="nip" required class="form-control">
            </div>
            <div>
              <label for="mapel" class="form-label">Mata Pelajaran</label>
              <select name="mapel" id="" class="form-select" required>
                <option selected value="">Pilih Mata Pelajaran</option>
                <?php foreach($mapel as $row):?>
                <option value="<?=$row[0]?>"><?=$row[1]?></option>
                <?php endforeach?>
              </select>
            </div>
            <div>
              <label for="kelas" class="form-label">Kelas</label>
              <select name="kelas" id="" class="form-select" required>
                <option selected value="">Pilih Kelas</option>
                <?php foreach($kelas as $row):?>
                <option value="<?=$row[0]?>"><?=$row[1]?></option>
                <?php endforeach?>
              </select>
            </div>
            <div>
              <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
              <input type="text" placeholder="Tempat Lahir" autofocus name="tempat_lahir" class="form-control">
            </div>
            <div>
              <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
              <input type="date" autofocus name="tanggal_lahir" class="form-control">
            </div>
            <div>
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" placeholder="Alamat" autofocus name="alamat" class="form-control">
            </div>
            <div>
              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
              <select name="jenis_kelamin" id="" class="form-select">
                <option selected value="">Pilih Jenis Kelamin</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div>
              <label for="agama" class="form-label">Agama</label>
              <select name="agama" id="" class="form-select">
                <option selected value="">Pilih Agama</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Islam">Islam</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
              </select>
            </div>
            <div>
              <label for="jabatan" class="form-label">Jabatan</label>
              <input type="text" placeholder="Jabatan" autofocus name="jabatan" class="form-control">
            </div>
            <div>
              <label for="no_telp" class="form-label">No. Telepon</label>
              <input type="text" placeholder="No. Telepon" autofocus name="no_telp" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editGuru" tabindex="-1" aria-labelledby="editGuruLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editGuruLabel">Edit Guru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/editGuru.php?id=" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="nama_guru" class="form-label">Nama Guru</label>
              <input type="text" placeholder="Nama Guru" autofocus name="nama_guru" required class="form-control">
            </div>
            <div>
              <label for="nip" class="form-label">NIP</label>
              <input type="text" pattern="\d*" maxlength="18" placeholder="NIP Guru" autofocus name="nip" required class="form-control">
            </div>
            <div>
              <label for="mapel" class="form-label">Mata Pelajaran</label>
              <select name="mapel" id="" class="form-select" required>
                <option selected value="">Pilih Mata Pelajaran</option>
                <?php foreach($mapel as $row):?>
                <option value="<?=$row[0]?>"><?=$row[1]?></option>
                <?php endforeach?>
              </select>
            </div>
            <div>
              <label for="kelas" class="form-label">Kelas</label>
              <select name="kelas" id="" class="form-select" required>
                <option selected value="">Pilih Kelas</option>
                <?php foreach($kelas as $row):?>
                <option value="<?=$row[0]?>"><?=$row[1]?></option>
                <?php endforeach?>
              </select>
            </div>
            <div>
              <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
              <input type="text" placeholder="Tempat Lahir" autofocus name="tempat_lahir" class="form-control">
            </div>
            <div>
              <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
              <input type="date" autofocus name="tanggal_lahir" class="form-control">
            </div>
            <div>
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" placeholder="Alamat" autofocus name="alamat" class="form-control">
            </div>
            <div>
              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
              <select name="jenis_kelamin" id="" class="form-select">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div>
              <label for="agama" class="form-label">Agama</label>
              <select name="agama" id="" class="form-select">
                <option value="">Pilih Agama</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Islam">Islam</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
              </select>
            </div>
            <div>
              <label for="jabatan" class="form-label">Jabatan</label>
              <input type="text" placeholder="Jabatan" autofocus name="jabatan" class="form-control">
            </div>
            <div>
              <label for="no_telp" class="form-label">No. Telepon</label>
              <input type="text" placeholder="No. Telepon" autofocus name="no_telp" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="hapusGuru" tabindex="-1" aria-labelledby="hapusGuruLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin menghapus guru ini ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a class="btn btn-danger" href="./controllers/hapusGuru.php?id=">Hapus Guru</a>
        </div>
      </div>
    </div>
  </div>

  </main>

<?php require './partial/footer.php'?>
