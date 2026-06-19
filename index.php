<?php
session_start();

// Jika sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['no_kamandaya'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kamandaya Tracer Study</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --man-dark: #064e3b;
            --man-green: #166534;
            --man-light: #22c55e;
            --man-gold: #f59e0b;
            --text-dark: #0f172a;
            --text-muted: #64748b;
        }

        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden; /* Mencegah scrollbar karena efek blur di luar layar */
        }

        /* --- EFEK AURORA DI BACKGROUND LUAR (KREATIF & MEWAH) --- */
        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            z-index: 0;
            animation: floatOrb 10s infinite alternate ease-in-out;
            pointer-events: none; /* Agar tidak mengganggu klik */
        }

        .orb-1 {
            top: -10%; left: -5%;
            width: 50vw; height: 50vw;
            background: rgba(22, 101, 52, 0.15); /* Hijau Zamrud */
        }

        .orb-2 {
            bottom: -15%; right: -5%;
            width: 45vw; height: 45vw;
            background: rgba(245, 158, 11, 0.12); /* Emas */
            animation-delay: -5s;
        }

        .orb-3 {
            top: 15%; right: -10%;
            width: 40vw; height: 40vw;
            background: rgba(6, 78, 59, 0.1); /* Hijau Gelap */
            animation-delay: -2s;
        }

        @keyframes floatOrb {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(30px, -40px) scale(1.1); }
        }

        /* --- KOTAK LOGIN UTAMA --- */
        .login-wrapper {
            background: white; border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(6, 78, 59, 0.15);
            overflow: hidden; width: 100%; max-width: 1050px; 
            display: flex; flex-wrap: wrap;
            position: relative; z-index: 1; /* Harus di atas background orb */
            border: 1px solid rgba(255,255,255,0.5);
            backdrop-filter: blur(10px);
        }

        /* --- PANEL KIRI (Branding) --- */
        .branding-panel {
            background: var(--man-dark); padding: 60px 50px; color: white;
            position: relative; display: flex; flex-direction: column; justify-content: space-between;
            overflow: hidden; flex: 1; min-width: 350px;
        }

        /* Ornamen internal panel kiri */
        .branding-panel::before {
            content: ''; position: absolute; top: -10%; left: -20%; width: 400px; height: 400px;
            border-radius: 50%; background: var(--man-light); opacity: 0.2; filter: blur(60px); pointer-events: none;
        }
        .branding-panel::after {
            content: ''; position: absolute; bottom: -15%; right: -10%; width: 350px; height: 350px;
            border-radius: 50%; background: var(--man-gold); opacity: 0.15; filter: blur(50px); pointer-events: none;
        }

        .logo-circle {
            width: 65px; height: 65px; background: white; border-radius: 50%; display: flex;
            align-items: center; justify-content: center; color: var(--man-green); font-size: 2rem;
            margin-bottom: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); position: relative; z-index: 2;
        }

        .brand-title { font-size: 2.5rem; line-height: 1.1; margin-bottom: 15px; position: relative; z-index: 2; }
        .brand-subtitle { font-size: 15px; opacity: 0.85; line-height: 1.6; max-width: 320px; position: relative; z-index: 2; }
        
        .badge-motto {
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 10px 18px; border-radius: 12px; display: inline-block; font-size: 11.5px;
            font-weight: 800; letter-spacing: 1px; color: #fef3c7; position: relative; z-index: 2;
        }

        /* --- PANEL KANAN (Form area dibersihkan tanpa grid) --- */
        .form-panel {
            padding: 60px 50px; flex: 1.2; min-width: 400px; display: flex; flex-direction: column; justify-content: center;
            background: #ffffff; position: relative; z-index: 2;
        }

        .form-label { font-size: 11.5px; font-weight: 800; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }

        .modern-input-group {
            display: flex; align-items: center; background: #f8fafc; border-radius: 14px;
            border: 2px solid transparent; transition: all 0.3s ease; margin-bottom: 25px; overflow: hidden;
        }
        
        .modern-input-group i { padding: 0 0 0 20px; color: #94a3b8; font-size: 1.2rem; transition: 0.3s; }
        .modern-input-group input {
            border: none; background: transparent; padding: 16px 15px; width: 100%;
            font-size: 15px; font-weight: 600; color: var(--text-dark); outline: none; box-shadow: none;
        }
        .modern-input-group input::placeholder { color: #cbd5e1; font-weight: 500; }

        .modern-input-group:focus-within {
            background: #ffffff; border-color: var(--man-green); box-shadow: 0 8px 20px rgba(22, 101, 52, 0.08);
        }
        .modern-input-group:focus-within i { color: var(--man-green); }

        .btn-login {
            background: linear-gradient(135deg, var(--man-green) 0%, var(--man-dark) 100%);
            border: none; padding: 16px; font-weight: 700; font-size: 15px;
            border-radius: 16px; color: white; transition: all 0.3s; width: 100%;
            box-shadow: 0 10px 20px rgba(6, 78, 59, 0.15); position: relative; overflow: hidden;
        }
        
        .btn-login::after {
            content: ''; position: absolute; top: -50%; left: -60%; width: 20%; height: 200%;
            background: rgba(255,255,255,0.2); transform: rotate(30deg); transition: 0.5s;
        }
        .btn-login:hover { transform: translateY(-3px); box-shadow: 0 15px 25px rgba(6, 78, 59, 0.25); }
        .btn-login:hover::after { left: 120%; }

        .link-text { color: var(--man-green); text-decoration: none; font-weight: 700; transition: 0.2s; }
        .link-text:hover { color: var(--man-dark); text-decoration: underline; }

        @media (max-width: 768px) {
            .branding-panel { padding: 40px; text-align: center; align-items: center; }
            .brand-subtitle { margin: 0 auto; }
            .form-panel { padding: 40px; min-width: 100%; }
        }
    </style>
</head>
<body>

    <!-- ORNAMEN BACKGROUND CAHAYA MELAYANG -->
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="bg-orb orb-3"></div>

    <div class="login-wrapper">
        
        <!-- PANEL KIRI -->
        <div class="branding-panel">
            <div>
                <div class="logo-circle">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <h1 class="fw-800 brand-title">
                    Kamandaya<br>
                    <span style="color: var(--man-gold);">Tracer Study</span>
                </h1>
                <p class="brand-subtitle">
                    Portal resmi sistem informasi dan jejak karir Keluarga Alumni MAN 2 Yogyakarta.
                </p>
            </div>
            
            <div class="mt-5">
                <div class="badge-motto">
                    <i class="bi bi-stars text-warning me-1"></i> BERAKHLAK MULIA & BERPRESTASI
                </div>
            </div>
        </div>

        <!-- PANEL KANAN (KREATIF & BERSIH) -->
        <div class="form-panel">
            <div class="mb-5">
                <h3 class="fw-800 text-dark mb-2">Selamat Datang Kembali! 👋</h3>
                <p class="text-muted" style="font-size: 14.5px;">Silakan masuk menggunakan kredensial Kamandaya Anda.</p>
            </div>

            <!-- Notifikasi Error -->
            <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'gagal'): ?>
            <div class="alert alert-danger d-flex align-items-center rounded-4 border-0 bg-danger bg-opacity-10 text-danger fw-bold mb-4" role="alert" style="font-size: 13.5px; padding: 15px 20px;">
                <i class="bi bi-exclamation-octagon-fill fs-5 me-3"></i> 
                <div>Username atau Password salah!</div>
            </div>
            <?php endif; ?>

            <form action="login_proses.php" method="POST">
                
                <!-- Input Username -->
                <label class="form-label">Nomor Kamandaya / Username</label>
                <div class="modern-input-group">
                    <i class="bi bi-person-fill"></i>
                    <input type="text" name="no_kamandaya" placeholder="Misal: KM-0000" required autocomplete="off">
                </div>

                <!-- Input Password -->
                <label class="form-label">Password Sistem</label>
                <div class="modern-input-group">
                    <i class="bi bi-lock-fill"></i>
                    <input type="password" name="password" placeholder="Masukkan kata sandi..." required>
                </div>

                <!-- Opsi Bawah Input -->
                <div class="d-flex justify-content-between align-items-center mb-5 mt-2" style="font-size: 13px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe" style="cursor: pointer;">
                        <label class="form-check-label text-muted fw-600" for="rememberMe" style="cursor: pointer;">
                            Ingat sesi saya
                        </label>
                    </div>
                    <!-- Ubah nomor telepon di bawah ini -->
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20lupa%20password%20akun%20Kamandaya." target="_blank" class="link-text">Lupa Sandi?</a>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn-login">
                    Masuk ke Dashboard <i class="bi bi-arrow-right-short ms-1 fs-5 align-middle"></i>
                </button>
            </form>

            <!-- Bantuan Bawah -->
            <div class="text-center mt-5 pt-3" style="border-top: 1px dashed #e2e8f0;">
                <p class="text-muted mb-1" style="font-size: 13px;">Belum terdaftar sebagai anggota?</p>
                <!-- Ubah nomor telepon di bawah ini -->
                <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20alumni%20ingin%20mendaftar%20Kamandaya." target="_blank" class="link-text" style="color: var(--man-gold);">
                    Hubungi Administrator MAN 2 YK
                </a>
            </div>
        </div>

    </div>

</body>
</html>