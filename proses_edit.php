<?php
session_start();
include 'koneksi.php';

if ($_SESSION['role'] != 'admin') { die("Akses Ditolak"); }

$id = $_POST['id'];
$no_kamandaya = mysqli_real_escape_string($conn, $_POST['no_kamandaya']);
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$angkatan = $_POST['angkatan'];
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

$query = "UPDATE users SET 
          no_kamandaya='$no_kamandaya', 
          nama='$nama', 
          email='$email', 
          angkatan='$angkatan', 
          alamat='$alamat' 
          WHERE id='$id'";

if (mysqli_query($conn, $query)) {
    header("Location: data_alumni.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>