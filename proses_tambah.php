<?php
session_start();
include 'koneksi.php';

if ($_SESSION['role'] != 'admin') { die("Akses Ditolak"); }

$no_kamandaya = mysqli_real_escape_string($conn, $_POST['no_kamandaya']);
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$tgl_lahir = $_POST['tanggal_lahir'];
$nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
$angkatan = $_POST['angkatan'];
$role = $_POST['role'];
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

// Membuat password default DDMMYY dari tanggal lahir (YYYY-MM-DD)
$pass_default = date('dmy', strtotime($tgl_lahir));

$query = "INSERT INTO users (no_kamandaya, password, role, nama, email, tanggal_lahir, nisn, angkatan, alamat) 
          VALUES ('$no_kamandaya', '$pass_default', '$role', '$nama', '$email', '$tgl_lahir', '$nisn', '$angkatan', '$alamat')";

if (mysqli_query($conn, $query)) {
    header("Location: data_alumni.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>