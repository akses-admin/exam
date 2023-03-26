<?php
$siswa = tampil_data('siswa', 'JOIN kelas ON siswa.id_kelas=kelas.id_kelas');

?>

<div class="container">
    <form method="POST">
        <div class="d-flex align-items-center mt-2">
            <div class="me-2 print  col-lg-4 ">
                <select class="form-select <?= has_error('siswa') ? 'is-invalid' : '' ?>" name="siswa" id="siswa" required>
                    <option value="" hidden>Pilih Siswa</option>
                    <?php foreach ($siswa as $sw) : ?>
                        <option value="<?= $sw['id_siswa'] ?>"><?= $sw['nisn'] ?> | <?= $sw['nama_siswa'] ?> | <?= $sw['nama_kelas'] ?> <?= $sw['jurusan'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <!-- <div class="me-2 print align-items-center col-lg-4 ">
                <input type="text" class="form-control print" placeholder="Cari dengan Nama Lengkap" name="nama_siswa">
            </div> -->
            <div class="me-2 mb-4 print">
                <input href="" type="submit" name="filter" value="Cari" class="btn btn-primary btn-fill pull-right mt-4 me-2 print">
            </div>
        </div>
    </form>
    <?php
    $no = 1;
    $filter = "";
    $level = $_SESSION['level'];

        if ($level == 'siswa') {
            $filter .= " AND siswa.id_siswa = '" . $_SESSION['user_id']  . "'";
        } else {
                if (isset($_POST['filter'])) {
                    // if (!empty($_POST['nama_siswa'])) {
                    //     $filter .= " AND nama_siswa = '" . $_POST['nama_siswa'] . "'";
                    // }
                    if (!empty($_POST['siswa'])) {
                        $filter .= " AND siswa.id_siswa = '" . $_POST['siswa'] . "'";
                    }
                } else {
                    $no = 1;
                    $filter = " AND nisn = '" . $no . "'";
                }
        }
    $transaksi = tampil_data('pembayaran', 'JOIN admin ON pembayaran.id_admin=admin.id_admin JOIN siswa ON pembayaran.id_siswa=siswa.id_siswa JOIN spp ON pembayaran.id_spp=spp.id_spp', "id_pembayaran > 0" . $filter . " ORDER BY tahun, spp_bulan");
    ?>
    <div class="row my-4">
        <div class="col-lg-3">
            <div class="card shadow-lg ">
                <?php
                $identitas = mysqli_query($conn, "SELECT nisn, nama_siswa, nama_kelas, alamat, jurusan FROM pembayaran  JOIN admin ON pembayaran.id_admin=admin.id_admin JOIN siswa ON pembayaran.id_siswa=siswa.id_siswa JOIN spp ON pembayaran.id_spp=spp.id_spp JOIN kelas On siswa.id_kelas=kelas.id_kelas  WHERE id_pembayaran > 0" . $filter);
                $row = mysqli_fetch_assoc($identitas);

                ?>
                <h3 class="card-header text-center">
                    IDENTITAS
                </h3>
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td style="width: 30% ;"><b>NISN</td>
                            <td style="width: 5% ; align: center;">:</td>
                            <td style="width: 65% ;"><?= $row['nisn'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Nama</td>
                            <td>:</td>
                            <td><?= $row['nama_siswa'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Kelas</td>
                            <td>:</td>
                            <td><?= $row['nama_kelas'] ?> <?= $row['jurusan'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Alamat</td>
                            <td>:</td>
                            <td><?= $row['alamat'] ?></td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>


        <div class="col-lg-9">
            <div class="card shadow">
                <div class="card-header text-white bg-secondary">
                    <h3 class="mb-0">SPP Siswa</h3>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-striped table-bordered  d-md-block d-lg-table overflow-auto">
                        <thead class="bg-light text-primary">
                            <tr>
                                <th>No</th>
                                <th>TRXID</th>
                                <th>Tahun Spp</th>
                                <th>SPP Bulan</th>
                                <th>Tanggal Bayar</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach ($transaksi as $trx) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>#<?= $trx['trxid'] ?></td>
                                    <td><?= $trx['tahun'] ?></td>
                                    <td><?= nama_bulan($trx['spp_bulan']) ?></td>
                                    <td><?= $trx['tgl_bayar'] ?></td>
                                    <td>Rp<?= number_format($trx['nominal'], '0', '.', '.') ?></td>
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
                                                        <input type="text" disabled class="form-control" id="alamat" name="alamat" value="<?= $trx['nominal'] ?>"></input>
                                                    </div>
                                                    <div class="mb-1">
                                                        <label for="recipient-name" class="col-form-label">Julah Bayar:</label>
                                                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $trx['jumlah_bayar'] ?>"></input>
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
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#siswa").select2({
            placeholder: 'Pilih Siswa'
        });
    });
</script>