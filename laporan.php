<?php
$title = 'Laporan Siswa | Absensi';
include 'koneksi.php';
date_default_timezone_set('Asia/jakarta');
?>

<style>
    @media print {
        .print,
        .navbar {
            display: none;
        }.container {
            width: 100%;
        }
    }.table {
        width: 100%;
    }.min_h {
        min-height: 510px;
    }
</style>
<div class="container col-lg-12">
    <center>
        <h1 class="mt-5">LAPORAN SPP SISWA</h1>
    </center>
    <br>
    <form method="POST">
        <div class="d-flex align-items-center">
            <div class="me-2 print">
                <label>Dari Tanggal : </label>
                <input type="date" class="form-control print" name="dari_tgl">
            </div>
            <div class="me-2 print">
                <label> Sampai Tanggal : </label>
                <input type="date" class="form-control print" name="sampai_tgl">
            </div>
            <div class="me-2 print">
                <label> NISN : </label>
                <input type="text" class="form-control print" name="nisn">
            </div>

            <div class="me-2 print">
                <input href="" type="submit" name="filter" value="Filter" class="btn btn-primary btn-fill pull-right mt-4 me-2 print">
            </div>
            <div class="ms-auto mt-5 print">
                <a href="" class="btn btn-success mb-2 print" onclick="window.print()"><i class="fas fa-print"></i> Cetak</a><br>
            </div>
        </div>
    </form>
    <table class="table table-bordered ">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Siswa</th>
                <th>Tanggal Bayar</th>
                <th>SPP Bulan</th>
                <th>Nominal</th>
                <th>Jumlah Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $filter = "";
            if (isset($_POST['filter'])) {
            

                if(!empty($_POST['dari_tgl']) && !empty($_POST['sampai_tgl'])){
                    $dari_tgl = mysqli_real_escape_string($conn, $_POST['dari_tgl']);
                    $sampai_tgl = mysqli_real_escape_string($conn, $_POST['sampai_tgl']);
                    $filter = " AND tgl_bayar >= '" . $dari_tgl . "'  AND tgl_bayar <= '" . $sampai_tgl . "'";

                }

                if (!empty($_POST['nisn'])) {
                    $filter .= " AND nisn = '" . $_POST['nisn'] . "'";
                }
            } else {
                $today = date("Y-m-d");
                $filter = " AND tgl_bayar = '" . $today . "'";
            }
            
            $querytransaksi = tampil_data('pembayaran', 'JOIN admin ON pembayaran.id_admin=admin.id_admin JOIN siswa ON pembayaran.id_siswa=siswa.id_siswa JOIN spp ON pembayaran.id_spp=spp.id_spp', "id_pembayaran > 0" . $filter . "ORDER BY tahun, spp_bulan");


            if (isset($querytransaksi)) {

                foreach ($querytransaksi as $trx) { ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $trx['nisn'] ?></td>
                        <td><?= $trx['nama_siswa'] ?></td>
                        <td><?= $trx['tgl_bayar'] ?></td>
                        <td><?= nama_bulan($trx['spp_bulan']) ?></td>
                        <td>Rp<?= number_format($trx['nominal'], '0', '.', '.') ?></td>
                        <td>Rp<?= number_format($trx['jumlah_bayar'], '0', '.', '.') ?></td>
                    </tr>
            <?php }
            }
            ?>
        </tbody>
    </table>
    