<?php
session_start();
include 'koneksi.php';

// Menangkap data dengan peredam error
$id             = $_POST['id'] ?? '';
$nama           = mysqli_real_escape_string($conn, $_POST['nama'] ?? '');
$nisn           = mysqli_real_escape_string($conn, $_POST['nisn'] ?? '');
$nomor_hp       = mysqli_real_escape_string($conn, $_POST['nomor_hp'] ?? '');
$email          = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
$tempat_lahir   = mysqli_real_escape_string($conn, $_POST['tempat_lahir'] ?? '');
$tanggal_lahir  = $_POST['tanggal_lahir'] ?? '';
$angkatan       = $_POST['angkatan'] ?? '';
$pekerjaan      = mysqli_real_escape_string($conn, $_POST['pekerjaan'] ?? '');
$instansi       = mysqli_real_escape_string($conn, $_POST['instansi'] ?? '');
$alamat         = mysqli_real_escape_string($conn, $_POST['alamat'] ?? '');

$foto = $_FILES['foto']['name'] ?? '';

if ($_SESSION['role'] == 'alumni' && $_SESSION['id'] != $id) {
    die("Akses Ditolak!");
}

if($foto != "") {
    $ekstensi_diperbolehkan = array('png','jpg','jpeg');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    $angka_acak = rand(1,9999);
    $nama_gambar_baru = $angka_acak.'-'.$foto; 

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        move_uploaded_file($file_tmp, 'uploads/'.$nama_gambar_baru);
        
        $query = "UPDATE users SET 
                    nama='$nama', nisn='$nisn', nomor_hp='$nomor_hp', 
                    email='$email', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', 
                    angkatan='$angkatan', pekerjaan='$pekerjaan', instansi='$instansi', 
                    alamat='$alamat', foto='$nama_gambar_baru' 
                  WHERE id='$id'";
    } else {
        echo "<script>alert('Gagal! Format foto harus JPG/PNG.');window.location='pengaturan.php';</script>";
        exit;
    }
} else {
    // Query update tanpa foto
    $query = "UPDATE users SET 
                nama='$nama', nisn='$nisn', nomor_hp='$nomor_hp', 
                email='$email', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', 
                angkatan='$angkatan', pekerjaan='$pekerjaan', instansi='$instansi', 
                alamat='$alamat' 
              WHERE id='$id'";
}

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Profil Berhasil Diperbarui!');window.location='pengaturan.php';</script>";
} else {
    echo "Error Database: " . mysqli_error($conn);
}
?>