<?php

if (isset($_POST['simpan'])) {

  tambah_data('kelas', [
    'nama_kelas' => post('kelas'),
    'jurusan' => post('jurusan'),



  ]);

  set_flash('success', 'Kelas berhasil ditambahkan');
  header('Location: index.php?page=kelas');
  exit;
}
?>
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card shadow-lg">
        <div class="card-header py-3">
          Form Input Kelas
        </div>
        <div class="card-body">
          <form action="" method="POST">
            <div class="mb-3">
              <label for="" class="form-label">Kelas</label>
              <input type="text" class="form-control" name="kelas" id="kelas" aria-describedby="helpId" placeholder="" required />
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Jurusan</label>
              <input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="" required />
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL . '/index.php?page=kelas' ?>" class=" btn btn-danger">Batal</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</main>