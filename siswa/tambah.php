<?php
$kelas = tampil_data('kelas');
$spp = tampil_data('spp');

if (isset($_POST['simpan'])) {

  tambah_data('siswa', [
    'nisn' => post('nisn'),
    'nama_siswa' => post('nama_siswa'),
    'email' => post('email'),
    'id_kelas' => post('kelas'),
    'alamat' => post('almt'),
    'no_telp' => post('no_telp'),
    'password' => password_hash("siswa", PASSWORD_DEFAULT),
    'id_spp' => post('spp')

  ]);

  set_flash('success', 'Siswa berhasil ditambahkan');
  header('Location: index.php?page=siswa');
}
?>
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-7">
      <div class="card shadow-lg">
        <div class="card-header py-3">
          Form Input Siswa
        </div>
        <div class="card-body">
          <form action="" method="POST">
            <div class="row">
              <div class="col-lg-4">
                <label for="" class="form-label">NISN</label>
                <input type="number" class="form-control" name="nisn" id="nisn" aria-describedby="helpId" placeholder="" required />
              </div>

              <div class="col-lg-5">
                <label for="" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" placeholder="" required />
              </div>

              <div class="col-lg-3">
                <label for="" class="form-label">Kelas</label>
                <select class="form-select" name="kelas" id="kelas" required>
                  <option value="" hidden>Pilih Kelas</option>
                  <?php foreach ($kelas as $kls) : ?>
                    <option value="<?= $kls['id_kelas'] ?>"><?= $kls['nama_kelas'] ?> <?= $kls['jurusan'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>


            </div>


            <div class="row">
              <div class="col-lg-4 mt-3">
                <label for="" class="form-label">No. Telepon</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="" required>
              </div>

              <div class="col-lg-5 mt-3">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="" required />
              </div>

              <div class="col-lg-3 mt-3">
                <label for="" class="form-label">SPP</label>
                <select class="form-select <?= has_error('spp') ? 'is-invalid' : '' ?>" name="spp" id="spp" required>
                  <option value="" hidden>Pilih SPP</option>
                  <?php foreach ($spp as $sp) : ?>
                    <option value="<?= $sp['id_spp'] ?>" <?= select_old('spp', last_value('spp')) ?>><?= $sp['tahun'] ?> | <?= number_format($sp['nominal'], '0', '.', '.') ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="mb-3 mt-3">
              <label for="" class="form-label">Alamat</label>
              <textarea class="form-control" name="almt" id="almt" rows="3" required></textarea>
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL . '/index.php?page=siswa' ?>" class=" btn btn-danger">Batal</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</main>