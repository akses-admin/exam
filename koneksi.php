<?php
// Membuat koneksi ke database
$hostname = "localhost"; // Nama server database
$username = "root"; // Username database
$password = ""; // Password database
$dbname = "db_spp"; // Nama database

// Membuat koneksi
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
