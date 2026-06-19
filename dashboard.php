<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['no_kamandaya'])) {
    header("Location: index.php");
    exit;
}

// Menghitung total alumni
$q_alumni = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='alumni'");
$d_alumni = mysqli_fetch_assoc($q_alumni);
$total_alumni = $d_alumni['total'];

// Rincian Pengurus (Sesuai dengan bagan organisasi di pengurus.php)
$jml_penasihat = 8;
$jml_ketum     = 1;
$jml_ketua     = 3;
$jml_lainnya   = 23; // (2 Sekre, 2 Benda, 19 Anggota Bidang)
$total_pengurus = $jml_penasihat + $jml_ketum + $jml_ketua + $jml_lainnya; // Total 35

include 'template_header.php'; // <--- Panggil template
?>

<!-- Tambahan CSS Khusus agar Dashboard terlihat lebih Modern & Premium -->
<style>
    .modern-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        position: relative;
        overflow: hidden;
        color: white;
    }
    .modern-hero::before {
        content: ''; position: absolute; top: -50px; right: -50px; width: 250px; height: 250px;
        background: linear-gradient(135deg, #166534, #064e3b); border-radius: 50%; opacity: 0.4; filter: blur(40px);
    }
    .modern-hero::after {
        content: ''; position: absolute; bottom: -50px; left: 10%; width: 150px; height: 150px;
        background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%; opacity: 0.2; filter: blur(30px);
    }
    .glass-btn {
        background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2); color: white; transition: all 0.3s;
    }
    .glass-btn:hover { background: rgba(255, 255, 255, 0.25); color: white; transform: translateY(-3px); }
    
    .stat-card-modern {
        padding: 40px 35px; border-radius: 28px; position: relative; overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); color: white; height: 100%;
        border: 1px solid rgba(255,255,255,0.1); display: flex; flex-direction: column; justify-content: space-between;
    }
    .stat-card-modern:hover { transform: translateY(-8px); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15); }
    .stat-card-modern .icon-bg {
        position: absolute; right: -15px; bottom: -20px; font-size: 130px; opacity: 0.15;
        transform: rotate(-15deg); line-height: 1; pointer-events: none;
    }

    /* PERBAIKAN: Menambahkan Warna Background Khas MAN untuk 2 Kotak Statistik */
    .bg-card-alumni {
        background: linear-gradient(135deg, #166534 0%, #064e3b 100%); /* Hijau Gelap */
        box-shadow: 0 10px 25px rgba(6, 78, 59, 0.2);
    }
    .bg-card-pengurus {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%); /* Emas Gelap */
        box-shadow: 0 10px 25px rgba(217, 119, 6, 0.2);
    }
    
    .info-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 20px; }
    .info-pill {
        background: rgba(255,255,255,0.2); padding: 6px 14px; border-radius: 20px;
        font-size: 11.5px; font-weight: 700; backdrop-filter: blur(5px);
    }
</style>

<div class="main-content">
    
    <!-- Top Header Bar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-800 m-0 text-dark">Dashboard Utama</h2>
            <p class="text-muted mt-1">Pantau statistik dan kepengurusan alumni secara real-time.</p>
        </div>
        <div class="badge bg-white shadow-sm px-4 py-3 rounded-pill text-dark fw-bold d-flex align-items-center" style="font-size: 13px; border: 1px solid #e2e8f0;">
            <i class="bi bi-calendar2-week-fill me-2 text-primary fs-6"></i> <?php echo date('d F Y'); ?>
        </div>
    </div>

    <!-- Modern Hero Banner -->
    <div class="card border-0 modern-hero p-5 rounded-5 mb-4 shadow-sm">
        <div class="row align-items-center position-relative" style="z-index: 1;">
            <div class="col-lg-8">
                <div class="d-inline-block px-3 py-1 rounded-pill mb-3 text-white" style="background: rgba(255,255,255,0.15); font-size: 11px; font-weight: 800; letter-spacing: 1px; backdrop-filter: blur(5px);">
                    <i class="bi bi-stars me-1 text-warning"></i> SISTEM TRACER V2
                </div>
                <!-- Mengambil nama dari session, jika kosong pakai kata Admin -->
                <h2 class="fw-bold mb-3" style="font-size: 2.2rem; line-height: 1.3;">Halo, <?php echo isset($_SESSION['nama']) ? explode(' ', $_SESSION['nama'])[0] : 'Admin'; ?>! 👋</h2>
                <p class="mb-4" style="font-size: 15px; opacity: 0.85; max-width: 600px; line-height: 1.6;">
                    Selamat datang di ruang kendali Alumni Tracer MAN 2 Yogyakarta. Kelola basis data alumni, pantau karir, dan lihat struktur kepengurusan dengan mudah di satu tempat.
                </p>
                
                <div class="d-flex gap-3 flex-wrap">
                    <a href="data_alumni.php" class="btn px-4 py-3 rounded-pill fw-bold shadow-sm d-flex align-items-center text-white" style="background: #166534; border: none;">
                        <i class="bi bi-people-fill me-2"></i> Data Alumni
                    </a>
                    <a href="pengurus.php" class="btn glass-btn px-4 py-3 rounded-pill fw-bold d-flex align-items-center">
                        <i class="bi bi-diagram-3-fill me-2"></i> Struktur Pengurus
                    </a>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block text-end">
                <i class="bi bi-rocket-takeoff" style="font-size: 10rem; color: rgba(255,255,255,0.9); filter: drop-shadow(0 15px 25px rgba(0,0,0,0.3));"></i>
            </div>
        </div>
    </div>

    <!-- Modern Stat Cards (2 Kolom Lebar) -->
    <div class="row g-4">
        <!-- Card Alumni (Hijau MAN) -->
        <div class="col-md-6">
            <div class="stat-card-modern bg-card-alumni">
                <div>
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase fw-bold mb-1" style="letter-spacing: 1.5px; opacity: 0.85; font-size: 12px;">Total Alumni Terdaftar</h6>
                            <h1 class="fw-bold m-0" style="font-size: 4rem;"><?php echo $total_alumni; ?> <span style="font-size: 1.2rem; opacity: 0.7; font-weight: 600;">Orang</span></h1>
                        </div>
                        <div class="bg-white rounded-circle d-flex justify-content-center align-items-center shadow-sm" style="width: 55px; height: 55px; color: #166534;">
                            <i class="bi bi-person-lines-fill fs-4"></i>
                        </div>
                    </div>
                    <div class="info-pills">
                        <span class="info-pill"><i class="bi bi-cloud-check-fill me-1"></i> Tersimpan di Database</span>
                    </div>
                </div>
                
                <div class="mt-4 pt-2">
                    <a href="data_alumni.php" class="btn btn-light fw-bold rounded-pill px-4 py-2 shadow-sm" style="font-size: 12.5px; position: relative; z-index: 2; color: #166534;">
                        Lihat Direktori Alumni <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="icon-bg"><i class="bi bi-people text-white"></i></div>
            </div>
        </div>

        <!-- Card Pengurus (Emas MAN) -->
        <div class="col-md-6">
            <div class="stat-card-modern bg-card-pengurus">
                <div>
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-uppercase fw-bold mb-1" style="letter-spacing: 1.5px; opacity: 0.85; font-size: 12px;">Total Pengurus Aktif</h6>
                            <h1 class="fw-bold m-0" style="font-size: 4rem;"><?php echo $total_pengurus; ?> <span style="font-size: 1.2rem; opacity: 0.7; font-weight: 600;">Orang</span></h1>
                        </div>
                        <div class="bg-white rounded-circle d-flex justify-content-center align-items-center shadow-sm" style="width: 55px; height: 55px; color: #d97706;">
                            <i class="bi bi-diagram-3-fill fs-4"></i>
                        </div>
                    </div>
                    
                    <!-- Rincian Berbentuk Pills Kapsul -->
                    <div class="info-pills">
                        <span class="info-pill"><?php echo $jml_penasihat; ?> Penasihat</span>
                        <span class="info-pill"><?php echo $jml_ketum; ?> Ketum</span>
                        <span class="info-pill"><?php echo $jml_ketua; ?> Ketua</span>
                        <span class="info-pill"><?php echo $jml_lainnya; ?> Anggota</span>
                    </div>
                </div>
                
                <div class="mt-4 pt-2">
                    <a href="pengurus.php" class="btn btn-light fw-bold rounded-pill px-4 py-2 shadow-sm" style="font-size: 12.5px; position: relative; z-index: 2; color: #d97706;">
                        Cek Bagan Detail <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="icon-bg"><i class="bi bi-diagram-2 text-white"></i></div>
            </div>
        </div>
    </div>
</div>

<?php include 'template_footer.php'; ?>