<?php
$siswa = tampil_data('siswa', 'JOIN kelas ON siswa.id_kelas=kelas.id_kelas JOIN spp ON siswa.id_spp=spp.id_spp');
$kelas = tampil_data('kelas');


if (isset($_POST['edit'])) {
    $id_siswa = $_POST['id_siswa'];
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];
    $tlp = $_POST['no_telp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];


    update_data(
        'siswa',
        [
            'nisn' => $nisn,
            'nama_siswa' => $nama,
            'id_kelas' => $kelas,
            'no_telp' => $tlp,
            'email' => $email,
            'alamat' => $alamat
        ],
        'id_siswa=' . $id_siswa
    );
    set_flash('success', 'Siswa berhasil diupdate');
    header('Location: index.php?page=siswa');
    exit;
}
?>
<div class="container mt-3">
    <?= flash() ?>

    <div class="card shadow-lg mt-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center px-3 pt-1">
                <div>
                    <h4 class="mb-0">Data Siswa</h4>
                </div>
                <div>
                    <a href="<?= BASE_URL . '/index.php?page=tambah_siswa' ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Siswa</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="table" class="table table-striped table-bordered  d-md-block d-lg-table overflow-auto">
                <thead class="bg-light text-primary">
                    <tr data-align="center">
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>No.Telepon</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($siswa as $sw) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $sw['nisn'] ?></td>
                            <td><?= $sw['nama_siswa'] ?></td>
                            <td><?= $sw['nama_kelas'] ?> <?= $sw['jurusan'] ?></td>
                            <td><?= $sw['email'] ?></td>
                            <td><?= $sw['alamat'] ?></td>
                            <td><?= $sw['no_telp'] ?></td>
                            <td>
                                <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $no ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>

                                <a href="<?= BASE_URL . '/index.php?page=hapus_siswa&id_siswa=' . $sw['id_siswa'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Ingin Menghapus Data?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>

                        <!-- MODAL EDIT -->
                        <div class="modal fade" id="staticBackdrop<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data Siswa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <input type="hidden" name="id_siswa" value="<?= $sw['id_siswa']; ?>">
                                            <div class="mb-1">
                                                <label for="recipient-name" class="col-form-label">NISN:</label>
                                                <input type="text" class="form-control" id="recipient-name" name="nisn" value="<?= $sw['nisn']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="recipient-name" class="col-form-label">Nama:</label>
                                                <input type="text" class="form-control" id="recipient-name" name="nama_siswa" value="<?= $sw['nama_siswa']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="" class="form-label">Kelas</label>
                                                <select class="form-select" name="kelas" id="kelas">
                                                    <?php foreach ($kelas as $kls) :
                                                        $selected = 0;
                                                        if ($sw['id_kelas'] == $kls['id_kelas'])

                                                            $selected = 'selected';

                                                    ?>
                                                        <option <?= $selected ?> value="<?= $kls['id_kelas'] ?>"><?= $kls['nama_kelas'] ?> <?= $kls['jurusan'] ?></option>
                                                    <?php endforeach ?>

                                                </select>
                                            </div>
                                            <div class="mb-1">
                                                <label for="recipient-name" class="col-form-label">No. Telepon:</label>
                                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $sw['no_telp']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="recipient-name" class="col-form-label">Email:</label>
                                                <input type="text" class="form-control" id="email" name="email" value="<?= $sw['email']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="recipient-name" class="col-form-label">Alamat:</label>
                                                <textarea class="form-control" id="alamat" name="alamat"><?= $sw['alamat']; ?></textarea>
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
                    <?php if (mysqli_num_rows($siswa) < 1) : ?>
                        <tr>
                            <td class="text-center" colspan="9">Tidak ada data!</td>
                        </tr>
                    <?php endif ?>


                </tbody>
            </table>
        </div>
    </div>
</div>