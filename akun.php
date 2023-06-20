<?php require './partial/header.php'?>
<?php 
  $conn = OpenCon();

  if(isset($_SESSION['role'])){
    if($_SESSION['role'] !== 'Admin'){
      header('Location: ./login.php');
      exit();
    }
  }

  $sql = "SELECT * FROM user WHERE user.role = 'Admin'";
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
      <h1>Akun</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="profil-sekolah.php">Home</a></li>
          <li class="breadcrumb-item active">Akun</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="d-flex justify-content-between mb-3">
            <div>
              <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahUser">
                <i class="bi bi-plus"></i>
                Tambah User
              </button>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Akun</h5>
              <div class="table-responsive">
                <table class="table datatable" id="datatable">
                  <thead>
                    <tr class="table-secondary">
                      <th scope="col" class="text-center">No</th>
                      <th scope="col" class="text-center">Nama</th>
                      <th scope="col" class="text-center">Username</th>
                      <th scope="col" class="text-center">Role</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $key=>$row):?>
                      <tr>
                        <td><?= $key + 1?></td>
                        <td><?= strtoupper($row['nama'])?></td>
                        <td><?= $row['username']?></td>
                        <td><?= $row['role']?></td>
                        <td class="d-flex gap-3 justify-content-center align-items-center">
                          <button type="button" id="btn-edit-user" class="btn btn-warning btn-sm" data-id="<?= $row['id']?>" data-user='{"id":"<?=$row['id']?>","nama":"<?=$row['nama']?>","username":"<?=$row['username']?>","role":"<?=$row['role']?>"}' data-bs-toggle="modal" data-bs-target="#editUser">
                            <i class="bi bi-pencil-square"></i>
                          </button>
                          <button type="button" id="btn-hapus-user" class="btn btn-danger btn-sm" data-id="<?= $row['id']?>" data-bs-toggle="modal" data-bs-target="#hapusUser">
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
    <div class="modal fade" id="tambahUser" tabindex="-1" aria-labelledby="tambahUserLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="tambahUserLabel">Tambah User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/tambahUser.php" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="nama" class="form-label">Nama User</label>
              <input type="text" value="" placeholder="Nama User" autofocus name="nama" required class="form-control">
            </div>
            <div>
              <label for="username" class="form-label">Username</label>
              <input type="text" value="" placeholder="Username" autofocus name="username" required class="form-control">
            </div>
            <div>
              <label for="password" class="form-label">Password</label>
              <input type="text" value="" placeholder="Password" autofocus name="password" required class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editUserLabel">Edit User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="./controllers/editUser.php?id=" method="POST" class=" w-100 d-flex flex-column gap-3 bg-white rounded p-4">
            <div>
              <label for="nama" class="form-label">Nama User</label>
              <input type="text" value="" placeholder="Nama User" autofocus name="nama" required class="form-control">
            </div>
            <div>
              <label for="username" class="form-label">Username</label>
              <input type="text" value="" placeholder="Username" autofocus name="username" required class="form-control">
            </div>
            <div>
              <label for="password" class="form-label">Password</label>
              <input type="password" value="" placeholder="Password" autofocus name="password" required class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-warning">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="hapusUser" tabindex="-1" aria-labelledby="hapusUserLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Anda yakin ingin menghapus user ini ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a class="btn btn-danger" href="./controllers/hapusUser.php?id=">Hapus User</a>
          </div>
        </div>
      </div>
    </div>

  </main>

<?php require './partial/footer.php'?>