<?php
  include './partial/header.php';


  if(isset($_SESSION['role'])){
    if($_SESSION['role'] !== 'Guru'){
      header('Location: ./login.php');
      exit();
    }
  }

  $id_siswa;
  if(isset($_REQUEST['id'])){
    $id_siswa = $_REQUEST['id'];
  }

  $querySiswa = "SELECT siswa.nama FROM siswa WHERE id_siswa = $id_siswa";
  $resultSiswa = $conn->query($querySiswa);
  $siswa = $resultSiswa->fetch_all();

  $queryMapel = "SELECT * FROM mapel ORDER BY mapel.nama_mapel ASC";
  $resultMapel = $conn->query($queryMapel);
  $mapel = $resultMapel->fetch_all();



  $sql = "SELECT nilai.*, siswa.nama, mapel.nama_mapel FROM nilai 
  LEFT JOIN siswa ON siswa.id_siswa = nilai.id_siswa 
  LEFT JOIN mapel ON mapel.id_mapel = nilai.id_mapel 
  WHERE nilai.id_siswa = $id_siswa 
  ";

  $result = $conn->query($sql); 
  $data = array();
  while ($row = $result->fetch_assoc()) {
      $data[] = $row; 
  }

  $conn->close();
  echo json_encode($data);

?>

        
  <?php if(isset($_SESSION['error'])):?>
    <div class="alert alert-danger" role="alert">
      <?= $_SESSION['error']; unset($_SESSION['error'])?>
    </div>
  <?php endif?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Nama Siswa</h1>
      <h1><b><?= $siswa[0][0]?></b></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Kelas Saya</li>
          <li class="breadcrumb-item active">Nilai Siswa</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">

           <div class="d-flex justify-content-end align-items-center gap-3 mb-2">
            <span>Semester :</span>
            <select id="mapelSelector" data-id="<?= $id_siswa?>" class="form-select w-25 ">
              <?php foreach($mapel as $row):?>
                <option value="<?= $row[0]?>" <?php if($row[0] == $id_mapel) echo "selected"?> ><?= $row[1]?></option>
              <?php endforeach?>
            </select>
          </div>

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Nilai Siswa</h5>
              <div class="table-responsive">
                <table class="table datatable" id="datatable">
                  <thead>
                    <tr class="table-secondary">
                      <th scope="col" class="text-center"></th>
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
                        <th><?= $row['nama_mapel']?></th>
                        <td><?= $row['nilai']?></td>
                        <td><?= $row['ulangan']?></td>
                        <td><?= $row['uts']?></td>
                        <td><?= $row['uas']?></td>
                        <td>
                          <?php if($row['approved']=="1"):?>
                            <span class="badge text-bg-success rounded-pill">Approved</span>
                            <?php else:?>
                              <button type="button" id="btn-approve-nilai" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#approveNilai">
                                <i class="bi bi-check2-all"></i>
                                Approve
                              </button>
                          <?php endif?>
                          </td>
                      </tr>

                      <div class="modal fade" id="approveNilai" tabindex="-1" aria-labelledby="approveNilaiLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>Nilai yang diapprove tidak bisa diubah lagi !!!</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <a class="btn btn-primary" href="../controllers/approveNilai.php?id=<?=$row['id_nilai']?>">Aprrove Nilai</a>
                            </div>
                          </div>
                        </div>
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

  </main>
  
  <?php include './partial/footer.php';?>