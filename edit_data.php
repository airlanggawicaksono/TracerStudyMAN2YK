<?php
session_start();
include 'koneksi.php';
if ($_SESSION['role'] != 'admin') { header("Location: dashboard.php"); exit; }

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='$id'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data - Alumni Tracer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="dashboard-body">
    <div class="main-content m-auto" style="max-width: 800px;">
        <div class="card border-0 shadow-sm rounded-4 p-4 mt-5">
            <h3 class="fw-bold mb-4">Edit Data Alumni</h3>
            <form action="proses_edit.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Nomor Kamandaya</label>
                        <input type="text" name="no_kamandaya" class="form-control" value="<?php echo $data['no_kamandaya']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Angkatan</label>
                        <input type="number" name="angkatan" class="form-control" value="<?php echo $data['angkatan']; ?>">
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-bold">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3"><?php echo $data['alamat']; ?></textarea>
                    </div>
                    <div class="col-12 mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                        <a href="data_alumni.php" class="btn btn-light px-4">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>