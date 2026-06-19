<?php
session_start();
if (!isset($_SESSION['no_kamandaya']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Alumni - Alumni Tracer</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8fafc; font-family: 'Plus Jakarta Sans', sans-serif; display: flex; }
        .sidebar { width: 280px; background: #0f172a; color: white; position: fixed; height: 100vh; padding: 30px 20px; }
        .main-content { margin-left: 280px; padding: 40px 50px; width: 100%; }
        .form-card { background: white; border-radius: 24px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: none; }
        .form-label { font-weight: 700; font-size: 13px; color: #64748b; text-transform: uppercase; margin-bottom: 8px; }
        .form-control { border-radius: 12px; border: 2px solid #f1f5f9; padding: 12px 18px; }
        .form-control:focus { border-color: #2563eb; box-shadow: none; background: #f8fafc; }
        .btn-primary { background: #2563eb; border: none; padding: 15px 30px; border-radius: 12px; font-weight: 700; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h5 class="fw-800 mb-4">Alumni Tracer</h5>
        <nav class="nav flex-column">
            <a href="dashboard.php" class="nav-link text-white-50 p-3"><i class="bi bi-grid-1x2-fill me-2"></i> Dashboard</a>
            <a href="data_alumni.php" class="nav-link text-white p-3 fw-bold"><i class="bi bi-people-fill me-2"></i> Data Alumni</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="mb-4">
            <a href="data_alumni.php" class="text-decoration-none small fw-bold text-primary"><i class="bi bi-arrow-left"></i> KEMBALI</a>
            <h2 class="fw-800 mt-2">Tambah Data Alumni</h2>
        </div>

        <div class="form-card">
            <form action="tambah_aksi.php" method="POST">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Ahsan Mubaarok" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nomor Kamandaya</label>
                        <input type="text" name="no_kamandaya" class="form-control" placeholder="Contoh: KM-202401" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">NISN</label>
                        <input type="text" name="nisn" class="form-control" placeholder="10 digit nomor">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Angkatan</label>
                        <input type="number" name="angkatan" class="form-control" placeholder="Contoh: 2024" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="email@contoh.com">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Kota Lahir">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                        <small class="text-muted">Password otomatis diset dari tanggal ini (DDMMYY)</small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Simpan & Buat Akun</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>