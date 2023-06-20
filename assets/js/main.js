
document.addEventListener('DOMContentLoaded', () => {
  const selectKls = document.getElementById('kelas')

  const selectKelas = document.getElementById('kelasSelector')

  const btnEdit = document.querySelectorAll('#btn-edit-siswa')
  const modalEditForm = document.querySelector('#editSiswa form')
  const btnDelete = document.querySelectorAll('#btn-hapus-siswa')
  const modalDeleteAnchor = document.querySelector('#hapusSiswa a')

  const btnEditGuru = document.querySelectorAll('#btn-edit-guru')
  const modalEditFormGuru = document.querySelector('#editGuru form')
  const btnDeleteGuru = document.querySelectorAll('#btn-hapus-guru')
  const modalDeleteAnchorGuru = document.querySelector('#hapusGuru a')

  const btnEditMapel = document.querySelectorAll('#btn-edit-mapel')
  const modalEditFormMapel = document.querySelector('#editMapel form')
  const btnDeleteMapel = document.querySelectorAll('#btn-hapus-mapel')
  const modalDeleteAnchorMapel = document.querySelector('#hapusMapel a')

  const btnEditJadwal = document.querySelectorAll('#btn-edit-jadwal')
  const modalEditFormJadwal = document.querySelector('#editJadwal form')
  const btnDeleteJadwal = document.querySelectorAll('#btn-hapus-jadwal')
  const modalDeleteAnchorJadwal = document.querySelector('#hapusJadwal a')

  const btnEditUser = document.querySelectorAll('#btn-edit-user')
  const modalEditFormUser = document.querySelector('#editUser form')
  const btnDeleteUser = document.querySelectorAll('#btn-hapus-user')
  const modalDeleteAnchorUser = document.querySelector('#hapusUser a')

  const btnEditNilai = document.querySelectorAll('#btn-edit-nilai')
  const modalEditFormNilai = document.querySelector('#editNilai form')


  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener))
    } else {
      select(el, all).addEventListener(type, listener)
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Sidebar toggle
   */
  if (select('.toggle-sidebar-btn')) {
    on('click', '.toggle-sidebar-btn', function(e) {
      select('body').classList.toggle('toggle-sidebar')
    })
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  $(document).ready(function () {
    $('#datatable').DataTable();
  });
  
  selectKls?.addEventListener('change',()=>{
    const id = selectKls?.value;
    window.location = 'kelas.php?id=' + id
  })
  
  selectKelas?.addEventListener('change',()=>{
    const id = selectKelas?.value;
      window.location =  `nilai-mapel.php?id=${id}`
  })
  
  btnEdit?.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const data = JSON.parse(btn.dataset.siswa)
      console.log(data)
      modalEditForm['nama'].value = data.nama
      modalEditForm['nis'].value = data.nis
      modalEditForm['tempat_lahir'].value = data.tempat_lahir
      modalEditForm['tanggal_lahir'].value = data.tanggal_lahir
      modalEditForm['jenis_kelamin'].value = data.jenis_kelamin
      modalEditForm['agama'].value = data.agama
      modalEditForm['alamat'].value = data.alamat
      modalEditForm['nama_ayah'].value = data.nama_ayah
      modalEditForm['nama_ibu'].value = data.nama_ibu
      modalEditForm['pekerjaan_ayah'].value = data.pekerjaan_ayah
      modalEditForm['pekerjaan_ibu'].value = data.pekerjaan_ibu
      modalEditForm['thn_semester'].value = data.thn_semester
      modalEditForm['no_telp'].value = data.no_telp
      modalEditForm.action = `./controllers/editSiswa.php?id=${data?.id_siswa}`
    })
  })
  
  btnEditGuru?.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const data = JSON.parse(btn.dataset.guru)
      console.log(data)
      modalEditFormGuru['nama_guru'].value = data.nama_guru
      modalEditFormGuru['nip'].value = data.nip
      modalEditFormGuru['tempat_lahir'].value = data.tempat_lahir
      modalEditFormGuru['kelas'].value = data.id_kelas
      modalEditFormGuru['tanggal_lahir'].value = data.tanggal_lahir
      modalEditFormGuru['jenis_kelamin'].value = data.jenis_kelamin
      modalEditFormGuru['agama'].value = data.agama
      modalEditFormGuru['alamat'].value = data.alamat
      modalEditFormGuru['jabatan'].value = data.jabatan
      modalEditFormGuru['no_telp'].value = data.no_telp
      modalEditFormGuru['mapel'].value = data.id_mapel
      modalEditFormGuru.action = `./controllers/editGuru.php?id=${data?.id_guru}`
      
    })
  })
  
  btnEditMapel?.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const data = JSON.parse(btn.dataset.mapel)
      console.log(data)
      modalEditFormMapel['nama_mapel'].value = data.nama_mapel
      modalEditFormMapel.action = `./controllers/editMapel.php?id=${data?.id_mapel}`
    })
  })
  
  btnEditJadwal?.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const data = JSON.parse(btn.dataset.jadwal)
      console.log(data)
      modalEditFormJadwal['hari'].value = data.hari
      modalEditFormJadwal['kelas'].value = data.id_kelas
      modalEditFormJadwal['mapel'].value = data.id_mapel
      modalEditFormJadwal['waktu_mulai'].value = data.waktu_mulai
      modalEditFormJadwal['waktu_selesai'].value = data.waktu_selesai
      modalEditFormJadwal.action = `./controllers/editJadwal.php?id=${data?.id_jadwal}`
    })
  })
  
  btnEditUser?.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const data = JSON.parse(btn.dataset.user)
      console.log(data)
      modalEditFormUser['nama'].value = data.nama
      modalEditFormUser['username'].value = data.username
      // modalEditFormUser['role'].value = data.role
      modalEditFormUser.action = `./controllers/editUser.php?id=${data?.id}`
    })
  })
  
  btnEditNilai?.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const data = JSON.parse(btn.dataset.nilai)
      console.log(data)
      modalEditFormNilai['nilai'].value = data.nilai
      modalEditFormNilai['ulangan'].value = data.ulangan
      modalEditFormNilai['uts'].value = data.uts
      modalEditFormNilai['uas'].value = data.uas
      // modalEditFormNilai['role'].value = data.role
      modalEditFormNilai.action = `../controllers/editNilai.php?id_nilai=${data?.id_nilai}&id_siswa=${data?.idSiswa}&id_mapel=${data?.id_mapel}`
    })
  })
  
  btnDelete?.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      modalDeleteAnchor.href = `./controllers/hapusSiswa.php?id=${btn.dataset.id}`
    })
  })
  
  btnDeleteGuru?.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      modalDeleteAnchorGuru.href = `./controllers/hapusGuru.php?id=${btn.dataset.id}`
    })
  })
  
  btnDeleteMapel?.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      modalDeleteAnchorMapel.href = `./controllers/hapusMapel.php?id=${btn.dataset.id}`
    })
  })
  
  btnDeleteJadwal?.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      modalDeleteAnchorJadwal.href = `./controllers/hapusJadwal.php?id=${btn.dataset.id}`
    })
  })
  
  btnDeleteUser?.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      modalDeleteAnchorUser.href = `./controllers/hapusUser.php?id=${btn.dataset.id}`
    })
  })

})
