<?php

if (isset($_POST['simpan'])) {

  tambah_data('spp', [
    'tahun' => post('tahun'),
    'nominal' => post('nominal'),



  ]);

  set_flash('success', 'SPP berhasil ditambahkan');
  header('Location: index.php?page=spp');
  exit;
}
?>
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card shadow-lg">
        <div class="card-header py-3">
          Form Input SPP
        </div>
        <div class="card-body">
          <form action="" method="POST">
            <div class="mb-3">
              <label for="" class="form-label">Tahun</label>
              <input type="number" class="form-control" name="tahun" id="tahun" aria-describedby="helpId" placeholder="" />
            </div>

            <div class="mb-3">
              <label for="" class="form-label">Nominal</label>
              <input type="number" class="form-control" name="nominal" id="nominal" placeholder="" />
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="<?= BASE_URL . '/index.php?page=spp' ?>" class=" btn btn-danger">Batal</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</main>