<?php
session_start();
include 'koneksi.php';

$no_kamandaya = mysqli_real_escape_string($conn, $_POST['no_kamandaya']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = mysqli_query($conn, "SELECT * FROM users WHERE no_kamandaya='$no_kamandaya' AND password='$password'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);
    $_SESSION['id'] = $data['id'];
    $_SESSION['no_kamandaya'] = $data['no_kamandaya'];
    $_SESSION['role'] = $data['role'];
    $_SESSION['nama'] = $data['nama'];
    
    header("Location: dashboard.php");
} else {
    echo "<script>alert('Login Gagal! Cek Nomor Kamandaya dan Password.'); window.location='index.php';</script>";
}
?>