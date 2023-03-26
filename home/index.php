<link rel="stylesheet" href="assets/css/sb-admin-2.min.css">
<div class="container my-5 py-2">
    <div class="row align-items-center">

        <?php
        $query_jml_rpl = mysqli_query($conn, "SELECT COUNT(*) AS jml_rpl  FROM  siswa JOIN kelas ON siswa.id_kelas=kelas.id_kelas  WHERE kelas.id_kelas IN (5,6,11,18)");
        $row = mysqli_fetch_assoc($query_jml_rpl)

        ?>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md">
            <div class="card border-left-warning shadow h-100 py-3">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                Rekayasa Perangkat Lunak</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                <?= $row['jml_rpl'] ?>  Siswa
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-2x fa-regular fa-computer" style="color: #eec911;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->

        <?php
        $query_jml_dkv = mysqli_query($conn, "SELECT nama_kelas FROM  kelas  WHERE id_kelas IN (1,2,3,7,8,12,13,14,15) GROUP BY nama_kelas");
        ?>
        <div class="col-xl-4 col-md-6 ">
            <div class="card border-left-primary shadow h-100 py-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                Desain Komunikasi Visual</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                <table>
                                    <?php
                                    while (($row = mysqli_fetch_assoc($query_jml_dkv)) != NULL) {

                                        $query_dkv = mysqli_query($conn, "SELECT COUNT(*) AS jml_dkv FROM siswa JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE nama_kelas='" . $row['nama_kelas'] . "' AND  kelas.id_kelas IN (1,2,3,7,8,12,13,14,15)");
                                        $row_dkv = mysqli_fetch_assoc($query_dkv);
                                    ?>

                                        <tr>
                                            <td style="width: 25% ;"><?= $row['nama_kelas'] ?></td>
                                            <td style="width: 15% ;">:</td>
                                            <td style="width: 20% ;"><?= $row_dkv['jml_dkv'] ?></td>
                                            <td style="width: 0% ;">Siswa</td>

                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                        <div class=" col-auto">
                            <i class="fas fa-2x fa-solid fa-camera-retro" style="color: #3170dd;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $query_jml_tkj = mysqli_query($conn, "SELECT nama_kelas FROM  kelas  WHERE id_kelas IN (4,9,10,16,17) GROUP BY nama_kelas");
        ?>
        <div class="col-xl-4 col-md-6 ">
            <div class="card border-left-danger shadow h-100 py-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-danger text-uppercase mb-1">
                                Teknik Komputer Jaringan</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800">
                                <table>
                                    <?php
                                    while (($row = mysqli_fetch_assoc($query_jml_tkj)) != NULL) {
                                            
                                        $query_tkj = mysqli_query($conn, "SELECT COUNT(*) AS jml_tkj FROM siswa JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE nama_kelas='" . $row['nama_kelas']. "' AND  kelas.id_kelas IN (4,9,10,16,17) ");
                                        $row_tkj = mysqli_fetch_assoc($query_tkj);
                                    ?>

                                        <tr>
                                            <td style="width: 25% ;"><?= $row['nama_kelas'] ?></td>
                                            <td style="width: 15% ;">:</td>
                                            <td style="width: 20% ;"><?= $row_tkj['jml_tkj'] ?></td>
                                            <td style="width: 0% ;">Siswa</td>

                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-2x fa-regular fa-server" style="color: #bf2222;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/sb-admin-2.min.js"></script>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#296969" fill-opacity="1" d="M0,288L80,240C160,192,320,96,480,85.3C640,75,800,149,960,186.7C1120,224,1280,224,1360,224L1440,224L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>