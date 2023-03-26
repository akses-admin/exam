<?php
$siswa = tampil_data('siswa', 'JOIN kelas ON siswa.id_kelas=kelas.id_kelas');
$spp = tampil_data('spp');

if (isset($_POST['simpan'])) {
	$check_riwayat = tampil_data('pembayaran', 'JOIN spp ON pembayaran.id_spp=spp.id_spp', 'id_siswa=' . post('siswa') . ' AND spp_bulan=' . post('bulan') . ' AND spp.id_spp=' . post('spp'));

	if (mysqli_num_rows($check_riwayat) > 0) {
		$riwayat = mysqli_fetch_assoc($check_riwayat);
		if ($riwayat['nominal'] == $riwayat['jumlah_bayar']) {
			set_flash('danger', 'Transaksi sudah ada');
			back();
			exit;
		}
	}



	tambah_data('pembayaran', [
		'trxid' => rand(111111, 999999),
		'id_admin' => $_SESSION['user_id'],
		'id_siswa' => post('siswa'),
		'tgl_bayar' => post('tanggal'),
		'spp_bulan' => post('bulan'),
		'id_spp' => post('spp'),
		'jumlah_bayar' => post('jumlah_bayar')
	]);

	set_flash('success', 'Transaksi berhasil ditambahkan');
	header('Location: index.php?page=transaksi');
	exit;
}
?>

<div class="container my-5">
	<div class="row justify-content-center">
		<div class="col-lg-6">
			<?= flash() ?>

			<div class="card shadow-lg">
				<div class="card-header py-3">
					<div class="d-flex align-items-center">
						<div class="me-2">
							<a href="<?= BASE_URL . '/index.php?page=transaksi' ?>" class="btn btn-light"><i class="bi bi-arrow-left"></i></a>
						</div>
						<div>
							<h4 class="mb-0">Tambah Transaksi</h4>
						</div>
					</div>
				</div>
				<div class="card-body">
					<form method="POST">
						<div class="mb-3">
							<label for="siswa" class="form-label">Siswa</label>
							<select class="form-select <?= has_error('siswa') ? 'is-invalid' : '' ?>" name="siswa" id="siswa" required>
								<option value="" hidden>Pilih Siswa</option>
								<?php foreach ($siswa as $sw) : ?>
									<option value="<?= $sw['id_siswa'] ?>" <?= select_old('siswa', last_value('siswa')) ?>><?= $sw['nama_siswa'] ?> | <?= $sw['nama_kelas'] ?> <?= $sw['jurusan'] ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= error('siswa') ?></div>
						</div>

						<div class="mb-3">
							<label for="tanggal" class="form-label">Tanggal Bayar</label>
							<input type="date" class="form-control <?= has_error('tanggal') ? 'is-invalid' : '' ?>" name="tanggal" id="tanggal" value="<?= old('tanggal') ?: date('Y-m-d') ?>" required>
							<div class="invalid-feedback"><?= error('tanggal') ?></div>
						</div>

						<div class="mb-3">
							<label for="bulan" class="form-label">Bulan</label>
							<select class="form-select <?= has_error('bulan') ? 'is-invalid' : '' ?>" name="bulan" id="bulan" required>
								<option value="" hidden>Pilih Bulan</option>
								<option value="1" <?= select_old('bulan', last_value('bulan')) ?>>Januari</option>
								<option value="2" <?= select_old('bulan', last_value('bulan')) ?>>Februari</option>
								<option value="3" <?= select_old('bulan', last_value('bulan')) ?>>Maret</option>
								<option value="4" <?= select_old('bulan', last_value('bulan')) ?>>April</option>
								<option value="5" <?= select_old('bulan', last_value('bulan')) ?>>Mei</option>
								<option value="6" <?= select_old('bulan', last_value('bulan')) ?>>Juni</option>
								<option value="7" <?= select_old('bulan', last_value('bulan')) ?>>Juli</option>
								<option value="8" <?= select_old('bulan', last_value('bulan')) ?>>Agustus</option>
								<option value="9" <?= select_old('bulan', last_value('bulan')) ?>>September</option>
								<option value="10" <?= select_old('bulan', last_value('bulan')) ?>>Oktober</option>
								<option value="11" <?= select_old('bulan', last_value('bulan')) ?>>November</option>
								<option value="12" <?= select_old('bulan', last_value('bulan')) ?>>Desember</option>
							</select>
							<div class="invalid-feedback"><?= error('bulan') ?></div>
						</div>

						<div class="mb-3">
							<label for="spp" class="form-label">SPP</label>
							<select class="form-select <?= has_error('spp') ? 'is-invalid' : '' ?>" name="spp" id="spp" required>
								<option value="" hidden>Pilih SPP</option>
								<?php foreach ($spp as $sp) : ?>
									<option value="<?= $sp['id_spp'] ?>" <?= select_old('spp', last_value('spp')) ?>><?= $sp['tahun'] ?> | <?= number_format($sp['nominal'], '0', '.', '.') ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= error('spp') ?></div>
						</div>

						<div class="mb-3">
							<label for="jumlah_bayar" class="form-label">Jumlah Bayar</label>
							<input type="number" class="form-control <?= has_error('jumlah_bayar') ? 'is-invalid' : '' ?>" name="jumlah_bayar" id="jumlah_bayar" value="<?= old('jumlah_bayar') ?>" placeholder="*Pastikan Bayar Dengan Uang Pas" required>
							<div class="invalid-feedback"><?= error('jumlah_bayar') ?></div>
						</div>

						<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
					</form>
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