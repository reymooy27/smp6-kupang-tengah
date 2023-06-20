<?php require './partial/header.php'?>
<?php 
  $conn = OpenCon();

  if(isset($_SESSION['role'])){
    if($_SESSION['role'] !== 'Admin'){
      header('Location: ./login.php');
      exit();
    }
  }

  $sql = "SELECT * FROM mapel";
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
      <h1>Mata Pelajaran</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="profil-sekolah.php">Home</a></li>
          <li class="breadcrumb-item active">Mata Pelajaran</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="d-flex justify-content-between mb-3">
            <div>
              <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahMapel">
                <i class="bi bi-plus"></i>
                Tambah Mapel
              </button>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Mata Pelajaran</h5>
              <div class="table-responsive">
                <table class="table datatable" id="datatable">
                  <thead>
                    <tr class="table-secondary">
                      <th scope="col" class="text-center">No</th>
                      <th scope="col" class="text-center">Nama</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $key=>$row):?>
                      <tr>
                        <td><?= $key + 1?></td>
                        <td><?= strtoupper($row['nama_mapel'])?></td>
                        <td class="d-flex gap-3 justify-content-center align-items-center">
                          <button type="button" id="btn-edit-mapel" class="btn btn-warning btn-sm" data-id="<?= $row['id_mapel']?>" data-mapel='{"id_mapel":"<?=$row['id_mapel']?>","nama_mapel":"<?=$row['nama_mapel']?>"}' data-bs-toggle="modal" data-bs-target="#editMapel">
                            <i class="bi bi-pencil-square"></i>
                          </button>
                          <button type="button" id="btn-hapus-mapel" class="btn btn-danger btn-sm" data-id="<?= $row['id_mapel']?>" data-bs-toggle="modal" data-bs-target="#hapusMapel">
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

    <!-- Modal -->
    <div class="modal fade" id="tambahMapel" tabindex="-1" aria-labelledby="tambahMapelLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tambahMapelLabel">Tambah Mapel</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/tambahMapel.php" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="nama_mapel" class="form-label">Nama Mapel</label>
              <input type="text" placeholder="Nama Mapel" autofocus name="nama_mapel" required class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editMapel" tabindex="-1" aria-labelledby="editMapelLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editMapelLabel">Edit Mapel</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/editMapel.php?id=" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="nama_mapel" class="form-label">Nama Mapel</label>
              <input type="text" value="" placeholder="Nama Mapel" autofocus name="nama_mapel" required class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="hapusMapel" tabindex="-1" aria-labelledby="hapusMapelLabel" aria-hidden="true">
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
            <a class="btn btn-danger" href="./controllers/hapusMapel.php?id=">Hapus Mapel</a>
          </div>
        </div>
      </div>
    </div>

  </main>

<?php require './partial/footer.php'?>