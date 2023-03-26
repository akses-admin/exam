
<?php

$spp = tampil_data('spp');

if (isset($_POST['edit'])) {
    $id = $_POST['id_spp'];
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];

    update_data(
        'spp',
        [
            'tahun' => $tahun,
            'nominal' => $nominal,

        ],
        'id_spp =' . $id
    );
    set_flash('success', 'SPP berhasil diupdate');
    header('Location: index.php?page=spp');
    exit;
}

?>
<div class="container mt-2">
    <?= flash() ?>

    <div class="card shadow-lg mt-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center px-3 pt-1">
                <div>
                    <h4 class="mb-0">Data SPP</h4>
                </div>
                <div>
                    <a href="<?= BASE_URL . '/index.php?page=tambah_spp' ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah SPP</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="table" class="table table-striped table-bordered  d-md-block d-lg-table overflow-auto">
                <thead class="bg-light text-primary">
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Nominal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($spp as $s) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $s['tahun'] ?></td>
                            <td>Rp.<?= number_format($s['nominal'], '0', '.', '.') ?></td>

                            <td>
                                <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $no ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="<?= BASE_URL . '/index.php?page=hapus_spp&id_spp=' . $s['id_spp'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Ingin Menghapus Data?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>

                        <!-- MODAL EDIT -->
                        <div class="modal fade" id="staticBackdrop<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data SPP</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <input type="hidden" name="id_spp" value="<?= $s['id_spp']; ?>">
                                            <div class="mb-1">
                                                <label for="recipient-name" class="col-form-label">Tahun:</label>
                                                <input type="text" class="form-control" id="recipient-name" name="tahun" value="<?= $s['tahun']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="recipient-name" class="col-form-label">Nama:</label>
                                                <input type="text" class="form-control" id="recipient-name" name="nominal" value="<?= $s['nominal']; ?>">
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary" name="edit" onclick=" return confirm('Simpan Perubahan???')">Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- MODAL EDIT END -->

                    <?php endforeach ?>
                    <?php if (mysqli_num_rows($spp) < 1) : ?>
                        <tr>
                            <td class="text-center" colspan="4">Tidak ada data!</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>