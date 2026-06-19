<?php
session_start();
include 'koneksi.php';

// Pastikan hanya admin yang bisa masuk ke file ini untuk menghapus
if ($_SESSION['role'] != 'admin') {
    die("Akses Ilegal! Hanya admin yang boleh menghapus data.");
}

// Menangkap ID yang dikirim dari tombol hapus (misal di URL /hapus_data.php?id=8)
$id = $_GET['id'];

// Menjalankan query untuk menghapus data berdasarkan ID
$query = "DELETE FROM users WHERE id='$id'";

if (mysqli_query($conn, $query)) {
    // Kalau berhasil dihapus, langsung kembali ke halaman data alumni
    header("Location: data_alumni.php");
    exit;
} else {
    // Kalau gagal, tampilkan pesan error dari database
    echo "Gagal menghapus data: " . mysqli_error($conn);
}
?>