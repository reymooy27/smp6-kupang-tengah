<?php require './partial/header.php'?>
<?php 
  $conn = OpenCon();

  if(isset($_SESSION['role'])){
    if($_SESSION['role'] !== 'Admin'){
      header('Location: ./login.php');
      exit();
    }
  }

  $queryKelas = "SELECT * FROM kelas ORDER BY kelas.kelas ASC";
  $resultKelas = $conn->query($queryKelas);
  $kelas = $resultKelas->fetch_all();

  
  $id_kelas = $_GET['id'] ?? $kelas[0][0];


  $queryGuru= "SELECT guru.nama_guru FROM guru WHERE guru.id_kelas = $id_kelas";
  $resultGuru = $conn->query($queryGuru);
  $wakel = $resultGuru->fetch_all();

  $current_kelas;

  
  foreach($kelas as $row){
    if($id_kelas == $row[0]){
      $current_kelas = $row;
    }
  }

  $sql = "SELECT * FROM siswa LEFT JOIN kelas ON kelas.id = '$id_kelas' WHERE siswa.kelasId = '$id_kelas'";
  $result = $conn->query($sql); 
  $data = array(); // initialize an empty array to store the rows
  while ($row = $result->fetch_assoc()) {
      $data[] = $row; // append each row to the data array
  }
  $conn->close();

?>
  <?php if(isset($_SESSION['error'])):?>
    <div class="alert alert-danger" role="alert">
      <?= $_SESSION['error']; unset($_SESSION['error'])?>
    </div>
  <?php endif?>
  <main id="main" class="main">

    <div class="pagetitle">
      <div class="mb-3 d-flex justify-content-between">
        <h1><?= $current_kelas ? "Kelas " . $current_kelas[1] : "Kelas" ?></h1>
        <h1>Wali Kelas : <?= $wakel ? $wakel[0][0] : 'Belum ada'?></h1>
      </div>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="profil-sekolah.php">Home</a></li>
          <li class="breadcrumb-item active">Kelas</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="d-flex justify-content-between mb-3">
            <div>
              <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahSiswa">
              <i class="bi bi-plus"></i>
              Tambah Siswa
            </button>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahKelas">
              <i class="bi bi-plus"></i>
                Tambah Kelas
              </button>
            </div>
            <div>
              <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editKelas">
                <i class="bi bi-pencil-square"></i>
                Edit Kelas
              </button>
              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusKelas">
                <i class="bi bi-trash"></i>
                Hapus Kelas
              </button>
            </div>
          </div>

        
        <div class="d-flex justify-content-end align-items-center gap-3 mb-2">
          <span>Pilih kelas :</span>
          <select id="kelas" class="form-select w-25 ">
            <?php foreach($kelas as $row):?>
              <option value="<?= $row[0]?>" <?php if($row[0] == $id_kelas) echo "selected"?> ><?= $row[1]?></option>
            <?php endforeach?>
          </select>
        </div>
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
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($data as $key=>$row):?>
                    <tr>
                      <td><?= $key + 1?></td>
                      <td><?= $row['nis']?></td>
                      <td><?= strtoupper($row['nama'])?></td>
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
                      <td class="d-flex gap-3">
                        <button type="button" id="btn-edit-siswa" class="btn btn-warning btn-sm" data-id="<?= $row['id_siswa']?>" data-siswa='{"id_siswa":"<?=$row['id_siswa']?>","nama":"<?=$row['nama']?>","nis":"<?=$row['nis']?>","tempat_lahir":"<?=$row['tempat_lahir']?>","tanggal_lahir":"<?=$row['tanggal_lahir']?>","jenis_kelamin":"<?=$row['jenis_kelamin']?>","agama":"<?=$row['agama']?>","alamat":"<?=$row['alamat']?>","nama_ayah":"<?=$row['nama_ayah']?>","nama_ibu":"<?=$row['nama_ibu']?>","pekerjaan_ayah":"<?=$row['pekerjaan_ayah']?>","pekerjaan_ibu":"<?=$row['pekerjaan_ibu']?>","thn_semester":"<?=$row['thn_semester']?>","no_telp":"<?=$row['no_telp']?>"}' data-bs-toggle="modal" data-bs-target="#editSiswa">
                        <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" id="btn-hapus-siswa" class="btn btn-danger btn-sm" data-id="<?= $row['id_siswa']?>" data-bs-toggle="modal" data-bs-target="#hapusSiswa">
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
    <div class="modal fade" id="tambahSiswa" tabindex="-1" aria-labelledby="tambahSiswaLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tambahSiswaLabel">Tambah Siswa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/tambahSiswa.php?id=<?= $id_kelas?>" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="nama" class="form-label">Nama Siswa</label>
              <input type="text" placeholder="Nama Siswa" autofocus name="nama" required class="form-control">
            </div>
            <div>
              <label for="nis" class="form-label">NIS</label>
              <input type="text" pattern="\d*" maxlength="10" placeholder="NIS" autofocus required name="nis" class="form-control">
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
              <label for="nama_ayah" class="form-label">Nama Ayah</label>
              <input type="text" placeholder="Nama Ayah" autofocus name="nama_ayah" class="form-control">
            </div>
            <div>
              <label for="nama_ibu" class="form-label">Nama Ibu</label>
              <input type="text" placeholder="Nama Ibu" autofocus name="nama_ibu" class="form-control">
            </div>
            <div>
              <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
              <input type="text" placeholder="Pekerjaan Ayah" autofocus name="pekerjaan_ayah" class="form-control">
            </div>
            <div>
              <label for="pekerjaan_ibu" class="form-label">Pekerjaan ibu</label>
              <input type="text" placeholder="Pekerjaan Ibu" autofocus name="pekerjaan_ibu" class="form-control">
            </div>
            <div>
              <label for="thn_semester" class="form-label">Semester</label>
              <input type="text" placeholder="Semester" autofocus name="thn_semester" class="form-control">
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

    <div class="modal fade" id="tambahKelas" tabindex="-1" aria-labelledby="tambahKelasLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tambahKelasLabel">Tambah Kelas</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/tambahKelas.php" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="kelas" class="form-label">Nama Kelas</label>
              <input type="text" autofocus name="kelas" required class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editKelas" tabindex="-1" aria-labelledby="editKelasLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editKelasLabel">Edit Kelas</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/editKelas.php?id=<?= $id_kelas?>" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="kelas" class="form-label">Nama Kelas</label>
              <input type="text" value="<?= $current_kelas[1]?>" autofocus name="kelas" required class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="hapusKelas" tabindex="-1" aria-labelledby="hapusKelasLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Anda yakin ingin menghapus kelas ini ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a class="btn btn-danger" href="./controllers/hapusKelas.php?id=<?=$id_kelas?>">Hapus Kelas</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editSiswa" tabindex="-1" aria-labelledby="editSiswaLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editSiswaLabel">Edit Siswa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/editSiswa.php?id=" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="nama" class="form-label">Nama Siswa</label>
              <input type="text" placeholder="Nama Siswa" autofocus name="nama" required class="form-control">
            </div>
            <div>
              <label for="nis" class="form-label">NIS</label>
              <input type="text" pattern="\d*" maxlength="10" placeholder="NIS" required autofocus name="nis" class="form-control">
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
              <label for="nama_ayah" class="form-label">Nama Ayah</label>
              <input type="text" placeholder="Nama Ayah" autofocus name="nama_ayah" class="form-control">
            </div>
            <div>
              <label for="nama_ibu" class="form-label">Nama Ibu</label>
              <input type="text" placeholder="Nama Ibu" autofocus name="nama_ibu" class="form-control">
            </div>
            <div>
              <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
              <input type="text" placeholder="Pekerjaan Ayah" autofocus name="pekerjaan_ayah" class="form-control">
            </div>
            <div>
              <label for="pekerjaan_ibu" class="form-label">Pekerjaan ibu</label>
              <input type="text" placeholder="Pekerjaan Ibu" autofocus name="pekerjaan_ibu" class="form-control">
            </div>
            <div>
              <label for="thn_semester" class="form-label">Semester</label>
              <input type="text" placeholder="Semester" autofocus name="thn_semester" class="form-control">
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

    <div class="modal fade" id="hapusSiswa" tabindex="-1" aria-labelledby="hapusSiswaLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Anda yakin ingin menghapus siswa ini ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a class="btn btn-danger" href="./controllers/hapusSiswa.php?id=">Hapus Siswa</a>
          </div>
        </div>
      </div>
    </div>

  </main><!-- End #main -->

  <?php require './partial/footer.php'?>