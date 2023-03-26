<?php
$transaksi = tampil_data('pembayaran', 'JOIN admin ON pembayaran.id_admin=admin.id_admin JOIN siswa ON pembayaran.id_siswa=siswa.id_siswa JOIN spp ON pembayaran.id_spp=spp.id_spp', 'id_pembayaran>0');
?>

<div class="container mt-2">
    <?= flash() ?>

    <div class="card shadow-lg mt-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center px-3 pt-1">
                <div>
                    <h4 class="mb-0">Data Transaksi</h4>
                </div>
                <div>
                    <a href="<?= BASE_URL . '/index.php?page=tambah_transaksi' ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Transaksi</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="table" class="table table-striped table-bordered  d-md-block d-lg-table overflow-auto">
                <thead class="bg-light text-primary">
                    <tr>
                        <th>No</th>
                        <th>TRXID</th>
                        <th>Admin</th>
                        <th>Siswa</th>
                        <th>Tanggal Bayar</th>
                        <th>SPP Bulan</th>
                        <th>Nominal</th>
                        <th>Jumlah Bayar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($transaksi as $trx) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>#<?= $trx['trxid'] ?></td>
                            <td><?= $trx['nama_admin'] ?></td>
                            <td><?= $trx['nama_siswa'] ?></td>
                            <td><?= date('d F Y', strtotime($trx['tgl_bayar'])) ?></td>
                            <td><?= nama_bulan($trx['spp_bulan']) ?></td>
                            <td>Rp<?= number_format($trx['nominal'], '0', '.', '.') ?></td>
                            <td>Rp<?= number_format($trx['jumlah_bayar'], '0', '.', '.') ?></td>
                            <td>
                                <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $no ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="<?= BASE_URL . '/index.php?page=hapus_transaksi&trxid=' . $trx['trxid'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Ingin Menghapus Data?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>


                        <!-- MODAL EDIT -->
                        <div class="modal fade" id="staticBackdrop<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data Transaksi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <input type="hidden" name="id_siswa" value="<?= $sw['id_siswa']; ?>">
                                            <div class="mb-1">
                                                <label for="recipient-name" class="col-form-label">TRXID:</label>
                                                <input type="" disabled class="form-control" id="recipient-name" name="nisn" value="#<?= $trx['trxid']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="recipient-name" class="col-form-label">Siswa:</label>
                                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $trx['nama_siswa']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="recipient-name" class="col-form-label">SPP Bulan:</label>
                                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= nama_bulan($trx['spp_bulan']) ?>"></input>
                                            </div>
                                            <div class="mb-1">
                                                <label for="recipient-name" class="col-form-label">Nominal:</label>
                                                <input type="text" disabled class="form-control" id="alamat" name="alamat" value="<?= $trx['nominal']?>"></input>
                                            </div>
                                            <div class="mb-1">
                                                <label for="recipient-name" class="col-form-label">Julah Bayar:</label>
                                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $trx['jumlah_bayar']?>"></input>
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
                    <?php if (mysqli_num_rows($transaksi) < 1) : ?>
                        <tr>
                            <td class="text-center" colspan="9">Tidak ada data!</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>