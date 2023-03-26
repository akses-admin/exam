<?php
include '../koneksi.php';
include '../fungsi.php';


if (isset($_GET['page']) && !isset($_SESSION['login'])) {
    header('Location: home.php');
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
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/css.css">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">

    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <link href="../assets/css2/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/datatables/datatables.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark  shadow-sm py-3">
            <div class="container">
                <a class="navbar-brand" href="./">
                    <img src="../assets/img/logo-letter-1.png" class="" width="50" alt="ubuntu logo">
                    <span class="text-white ms-2">SI SPP</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav<?= !isset($_SESSION['login']) ? ' ms-auto' : '' ?>">
                        <?php if (isset($_SESSION['login'])) : ?>
                            <li>
                                <a class="nav-link" href="<?= BASE_URL . '/index.php?page=transaksi' ?>">History Pembayaran</a>
                            </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="<?= BASE_URL . '/index.php?page=logout' ?>" onclick="return confirm('Ingin Logout?')"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </li>
                    </ul>

                </div>

            <?php else : ?>
                <a class="nav-link text-white" href="./">Login</a>
            <?php endif ?>

            </div>
        </nav>

        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script defer src="../assets/fontawesome/js/brands.js"></script>
        <script defer src="../assets/fontawesome/js/solid.js"></script>
        <script defer src="../assets/fontawesome/js/fontawesome.js"></script>

    </header>

    <main>
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : '';

        switch ($page) {

            case 'home':
                include 'home.php';
                break;
            case 'logout':
                include '../auth/logout_user.php';
                break;
            default:
                include '../auth/login.php';
        }
        ?>
    </main>

    <footer>

    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/jquery.js"></script>

    <script src="../assets/datatables/datatables.min.js"></script>

    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/sweetalert.js"></script>

    <script src="../assets/js/sb-admin-2.min.js"></script>

    <script src="../assets/js/alert.js"></script>
    <script src="../assets/datatables/datatables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>