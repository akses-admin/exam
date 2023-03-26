<?php

if (isset($_POST['simpan'])) {

  tambah_data('admin', [
    'nama_admin' => post('nama_admin'),
    'email' => post('email'),
    'password' => password_hash("siswa", PASSWORD_DEFAULT),

  ]);

  set_flash('success', 'Admin berhasil ditambahkan');
  header('Location: index.php?page=admin');
  exit;
}
?>
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card shadow-lg">
        <div class="card-header py-3">
          Form Input Admin
        </div>
        <div class="card-body">
          <form action="" method="POST">
            <div class="mb-3">
              <label for="" class="form-label">Nama</label>
              <input type="text" class="form-control" name="nama_admin" id="nama_admin" aria-describedby="helpId" placeholder="" required />
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="" required />
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL . '/index.php?page=admin' ?>" class=" btn btn-danger">Batal</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</main>