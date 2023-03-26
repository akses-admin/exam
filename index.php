<?php
include 'koneksi.php';
include 'fungsi.php';
// y
if (isset($_GET['page']) && !isset($_SESSION['login'])) {
	header('Location: index.php');
	exit;
} else if (!isset($_GET['page']) && isset($_SESSION['login'])) {
	header('Location: index.php?page=home');
	exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>SPP-APP</title>

	<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/css.css">
	<link href="assets/css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/fontawesome/css/fontawesome.css">
	<link rel="stylesheet" href="assets/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/fontawesome/css/all.css">


	<link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

	<!-- Bootstrap CSS v5.2.1 -->
	<link href="assets/css2/style.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/datatables/datatables.min.css">

	<!-- Bootstrap Icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

	<link href="assets/css/select2.min.css" rel="stylesheet" />
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/select2.min.js"></script>

</head>

<body>
	<header>
		<?php
		$level = '';
		if (!isset($_SESSION['level'])) {
			$level = 'admin';
		} else {
			$level = $_SESSION['level'];
		}
		?>
		<?php
		if ($level == 'admin') {
			$fix = '';
		} else {
			$fix = 'fixed-top';
		}
		if (isset($_SESSION['login'])) : ?>
			<nav class="navbar navbar-expand-lg navbar-dark <?= $fix ?> shadow-sm ">
				<div class="container">
					<a class="navbar-brand" href="#">
						<img src="assets/img/logo.png" class="" width="50" alt="bm3 logo">
						<span class="text-white ms-2">SMK BM3</span>
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav<?= !isset($_SESSION['login']) ? ' ms-auto' : '' ?>">
							<?php if (isset($_SESSION['login'])) : ?>
								<?php
								$level = $_SESSION['level']
								?>
								<?php
								if ($level == 'admin') : ?>
									<li>
										<a class="nav-link" href="<?= BASE_URL . '/index.php?page=home' ?>">Dashboard</a>
									</li>
									<li>
										<a class="nav-link" href="<?= BASE_URL . '/index.php?page=siswa' ?>">Siswa</a>
									</li>
									<li>
										<a class="nav-link" href="<?= BASE_URL . '/index.php?page=kelas' ?>">Kelas</a>
									</li>
									<li>
										<a class="nav-link" href="<?= BASE_URL . '/index.php?page=admin' ?>">Admin</a>
									</li>
									<li>
										<a class="nav-link" href="<?= BASE_URL . '/index.php?page=spp' ?>">SPP</a>
									</li>
									<li>
										<a class="nav-link" href="<?= BASE_URL . '/index.php?page=transaksi' ?>">Pembayaran</a>
									</li>
									<li>
										<a class="nav-link" href="<?= BASE_URL . '/index.php?page=laporan' ?>">Laporan</a>
									</li>
									<li>
										<a class="nav-link" href="<?= BASE_URL . '/index.php?page=history' ?>">History Pembayaran</a>
									</li>
								<?php else : ?>
									<li>
										<a class="nav-link" href="<?= BASE_URL . '/index.php?page=home_siswa' ?>">Dashboard</a>
									</li>
									<li>
										<a class="nav-link" href="<?= BASE_URL . '/index.php?page=history' ?>">History Pembayaran</a>
									</li>
								<?php endif  ?>


						</ul>
					</div>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav ms-auto">
							</li>
							<li class="nav-item">
								<a class="btn btn-danger " href="<?= BASE_URL . '/index.php?page=logout' ?>" onclick="return confirm('Ingin Logout?')"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
							</li>
						</ul>

					</div>

				<?php else : ?>
					<a class="nav-link text-white" href="./">Login</a>
				<?php endif ?>

				</div>
			</nav>
		<?php endif ?>
		<script src="js/bootstrap.bundle.min.js"></script>
		<script defer src="assets/fontawesome/js/brands.js"></script>
		<script defer src="assets/fontawesome/js/solid.js"></script>
		<script defer src="assets/fontawesome/js/fontawesome.js"></script>

	</header>

	<main>
		<?php
		$page = isset($_GET['page']) ? $_GET['page'] : '';

		switch ($page) {

			case 'home_siswa':
				include 'home_siswa.php';
				break;
			case 'home':
				include 'home/index.php';
				break;
			case 'siswa':
				include 'siswa/index.php';
				break;
			case 'tambah_siswa':
				include 'siswa/tambah.php';
				break;
			case 'hapus_siswa':
				include 'siswa/hapus.php';
				break;
			case 'kelas':
				include 'kelas/index.php';
				break;
			case 'tambah_kelas':
				include 'kelas/tambah.php';
				break;
			case 'hapus_kelas':
				include 'kelas/hapus.php';
				break;
			case 'admin':
				include 'admin/index.php';
				break;
			case 'tambah_admin':
				include 'admin/tambah.php';
				break;
			case 'hapus_admin':
				include 'admin/hapus.php';
				break;
			case 'spp':
				include 'spp/index.php';
				break;
			case 'tambah_spp':
				include 'spp/tambah.php';
				break;
			case 'hapus_spp':
				include 'spp/hapus.php';
				break;
			case 'transaksi':
				include 'transaksi/index.php';
				break;
			case 'tambah_transaksi':
				include 'transaksi/tambah.php';
				break;
			case 'hapus_transaksi':
				include 'transaksi/hapus.php';
				break;
			case 'laporan':
				include 'laporan.php';
				break;
			case 'history':
				include 'history.php';
				break;
			case 'logout':
				include 'auth/logout.php';
				break;
			default:
				include 'auth/login.php';
		}
		?>
	</main>

	<footer>

	</footer>
	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

	<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>



	<script src="assets/datatables/datatables.min.js"></script>

	<script src="assets/js/custom.js"></script>
	<script src="assets/js/sweetalert.js"></script>

	<script src="assets/js/sb-admin-2.min.js"></script>

	<script src="assets/datatables/datatables.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>


</body>

</html>