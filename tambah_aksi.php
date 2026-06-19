<?php
include 'koneksi.php';

$nama           = $_POST['nama'];
$no_kamandaya   = $_POST['no_kamandaya'];
$nisn           = $_POST['nisn'];
$angkatan       = $_POST['angkatan'];
$email          = $_POST['email'];
$tempat_lahir   = $_POST['tempat_lahir'];
$tanggal_lahir  = $_POST['tanggal_lahir']; // Format default HTML: YYYY-MM-DD
$alamat         = $_POST['alamat'];

// LOGIKA GENERATE PASSWORD (DDMMYY)
// Mengubah 2006-05-17 menjadi 170506
$password = date('dmy', strtotime($tanggal_lahir));

$query = "INSERT INTO users (nama, no_kamandaya, nisn, angkatan, email, tempat_lahir, tanggal_lahir, alamat, password, role) 
          VALUES ('$nama', '$no_kamandaya', '$nisn', '$angkatan', '$email', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$password', 'alumni')";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data Berhasil Ditambahkan! Password Alumni: $password'); window.location='data_alumni.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>