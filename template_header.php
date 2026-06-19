<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Tracer - MAN 2 YK</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            /* Palette Warna Khas MAN 2 YK */
            --man-dark: #064e3b;    /* Hijau Gelap */
            --man-green: #166534;   /* Hijau Zamrud */
            --man-light: #22c55e;   /* Hijau Terang */
            --man-gold: #f59e0b;    /* Emas Aksen */
            
            --primary: var(--man-green); 
            --dark: #0f172a; 
            --bg-light: #f8fafc;
            --line-color: #a7f3d0;
            --card-shadow: 0 4px 20px rgba(22, 101, 52, 0.08);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-light); display: flex; min-height: 100vh; flex-direction: column; }

        /* SIDEBAR THEME MAN */
        .sidebar { 
            width: 260px; 
            background: linear-gradient(180deg, var(--man-dark) 0%, var(--man-green) 100%); 
            color: white; position: fixed; height: 100vh; padding: 25px; display: flex; flex-direction: column; z-index: 1000; 
            box-shadow: 4px 0 20px rgba(6, 78, 59, 0.15);
        }
        .sidebar::before {
            content: ''; position: absolute; top: -50px; left: -50px;
            width: 150px; height: 150px; border-radius: 50%; background: rgba(255, 255, 255, 0.05); pointer-events: none;
        }

        .sidebar-header { margin-bottom: 25px; border-bottom: 1px dashed rgba(255,255,255,0.2); padding-bottom: 20px; text-align: center; position: relative; z-index: 2; }
        .sidebar-header .logo-icon { font-size: 2rem; color: var(--man-gold); margin-bottom: 5px; display: inline-block; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2)); }
        .sidebar-header h5 { font-weight: 800; margin: 0; color: white; letter-spacing: 0.5px; }
        .sidebar-header p { font-size: 11px; color: #a7f3d0; letter-spacing: 1px; margin-top: 5px; text-transform: uppercase; font-weight: 700; }
        
        .nav-link { color: #d1fae5; padding: 12px 15px; border-radius: 10px; margin-bottom: 5px; display: flex; align-items: center; text-decoration: none; font-weight: 600; transition: 0.3s; font-size: 14px; position: relative; z-index: 2; }
        .nav-link i { font-size: 1.2rem; margin-right: 12px; color: #6ee7b7; transition: 0.3s; }
        .nav-link:hover { background: rgba(255, 255, 255, 0.1); color: white; transform: translateX(5px); }
        
        /* Menu Aktif dengan Warna Emas */
        .nav-link.active { background: var(--man-gold); color: white; transform: translateX(5px); box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3); }
        .nav-link.active i { color: white; }

        .btn-logout { margin-top: auto; background: rgba(239, 68, 68, 0.15); color: #fca5a5; padding: 12px; border-radius: 10px; text-align: center; text-decoration: none; font-weight: 700; transition: 0.3s; border: 1px solid rgba(239, 68, 68, 0.2); position: relative; z-index: 2; }
        .btn-logout:hover { background: #ef4444; color: white; border-color: #ef4444; }

        /* KONTEN UTAMA */
        .main-content { margin-left: 260px; padding: 40px; width: calc(100% - 260px); min-height: calc(100vh - 80px); }
        .fw-800 { font-weight: 800; }

        /* TABEL DATA ALUMNI */
        .table-card { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); border: 1px solid #f1f5f9; }
        .sort-link { text-decoration: none; color: #64748b; font-weight: 700; font-size: 11px; display: flex; align-items: center; gap: 5px; text-transform: uppercase; transition: 0.2s; }
        .sort-link:hover { color: var(--man-green); }
        .avatar-sm { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0; }
        .avatar-placeholder { width: 40px; height: 40px; border-radius: 50%; background: #d1fae5; color: var(--man-green); display: flex; align-items: center; justify-content: center; }
        .btn-action { width: 30px; height: 30px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; color: white; text-decoration: none; font-size: 14px; }
        .table th { border-top: none; background: #f8fafc; padding: 12px; color: #334155; }
        .table td { padding: 15px 12px; font-size: 13px; }

        /* ID CARD & FORM (PENGATURAN) */
        .id-card { width: 100%; max-width: 750px; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.15); position: relative; margin-bottom: 40px; border: 1px solid #e2e8f0; }
        .card-header-green { background-color: var(--man-dark); color: white; padding: 15px 25px; display: flex; align-items: center; justify-content: space-between; border-bottom: 4px solid var(--man-gold); }
        .header-content { text-align: center; flex-grow: 1; }
        .header-content h6 { font-weight: 800; margin: 0; font-size: 22px; letter-spacing: 1px; color: var(--man-gold); text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
        .header-content p { font-size: 10px; margin: 0; opacity: 0.9; }
        .card-body-content { display: flex; padding: 25px; background: url('https://www.transparenttextures.com/patterns/cubes.png'); }
        .photo-section { width: 220px; height: 280px; background-color: #ef4444; border-radius: 8px; overflow: hidden; border: 3px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .photo-section img { width: 100%; height: 100%; object-fit: cover; }
        .info-section { flex-grow: 1; padding-left: 30px; }
        .info-section h4 { color: var(--man-dark); font-weight: 800; font-size: 28px; margin-bottom: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 5px; }
        .data-row { display: grid; grid-template-columns: 140px 20px 1fr; margin-bottom: 8px; font-size: 15px; color: #334155; }
        .data-label { font-weight: 700; color: #0f172a; }
        .card-footer-green { background-color: var(--man-dark); color: white; text-align: center; padding: 10px; font-size: 12px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; min-height: 40px; }
        .edit-room { background: white; border-radius: 20px; padding: 35px; border: 1px solid #e2e8f0; }
        .form-label { font-weight: 700; font-size: 12px; color: #64748b; text-transform: uppercase; margin-bottom: 8px; }
        .form-control { border-radius: 10px; padding: 12px; border: 2px solid #f1f5f9; }
        .form-control:focus { border-color: var(--man-green); box-shadow: 0 0 0 4px rgba(22, 101, 52, 0.1); }
        .btn-update { background: var(--man-green); color: white; border: none; padding: 15px 35px; border-radius: 10px; font-weight: 700; transition: 0.3s; }
        .btn-update:hover { background: var(--man-dark); transform: translateY(-2px); box-shadow: 0 10px 20px rgba(6, 78, 59, 0.2); }

        /* ORGANIGRAM (PENGURUS) */
        .header-title { margin-bottom: 30px; text-align: center; }
        .header-title h2 { font-weight: 800; color: var(--dark); letter-spacing: -1px; font-size: 2rem; }
        .section-label { font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; color: #94a3b8; margin-bottom: 16px; text-align: center; }
        .section-divider { border-top: 2px dashed #e2e8f0; margin: 30px 0 24px; }
        .v-line { width: 2px; height: 28px; background: var(--line-color); margin: 0 auto; }
        .h-bar { height: 2px; background: var(--line-color); }
        .penasihat-row { display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; }
        .card-penasihat { width: 140px; min-height: 110px; background: #fffbeb; border: 1.5px solid var(--man-gold); border-radius: 14px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 12px 10px; box-shadow: var(--card-shadow); transition: all 0.3s; }
        .card-penasihat:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(245, 158, 11, 0.2); }
        .card-penasihat .avatar { width: 36px; height: 36px; border-radius: 50%; background: #fef3c7; display: flex; align-items: center; justify-content: center; color: #b45309; margin-bottom: 8px; }
        .card-penasihat .name { font-weight: 700; font-size: 11.5px; line-height: 1.3; margin-bottom: 5px; }
        .card-penasihat .role-badge { font-size: 9px; font-weight: 700; text-transform: uppercase; background: #fef3c7; color: #b45309; padding: 2px 8px; border-radius: 20px; }
        .card-penasihat .angkatan { font-size: 9.5px; color: #94a3b8; margin-top: 3px; }
        .card-ketua-umum { width: 200px; background: linear-gradient(135deg, #f0fdf4, #fff); border: 2px solid var(--man-green); border-radius: 16px; display: flex; flex-direction: column; align-items: center; text-align: center; padding: 16px 14px; box-shadow: 0 8px 25px rgba(22, 101, 52, 0.15); margin: 0 auto; }
        .card-ketua-umum .avatar { width: 44px; height: 44px; border-radius: 50%; background: #d1fae5; display: flex; align-items: center; justify-content: center; color: var(--man-green); font-size: 1.3rem; margin-bottom: 10px; }
        .card-ketua-umum .name { font-weight: 800; font-size: 13px; line-height: 1.3; margin-bottom: 6px; }
        .card-ketua-umum .role-badge { font-size: 9.5px; font-weight: 700; text-transform: uppercase; background: var(--man-green); color: white; padding: 3px 10px; border-radius: 20px; }
        .card-ketua-umum .angkatan { font-size: 10px; color: #94a3b8; margin-top: 4px; }
        .level2-container { display: flex; justify-content: center; align-items: flex-start; position: relative; gap: 0; }
        .level2-hline { position: absolute; top: 0; left: calc(100% / 14); right: calc(100% / 14); height: 2px; background: var(--line-color); }
        .level2-col { flex: 1; display: flex; flex-direction: column; align-items: center; min-width: 0; padding: 0 10px; }
        .card-l2 { width: 150px; height: 140px; background: white; border-radius: 14px; border: 1.5px solid #e2e8f0; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 12px 8px; box-shadow: var(--card-shadow); transition: all 0.3s; }
        .card-l2:hover { transform: translateY(-5px); border-color: var(--man-green); box-shadow: 0 14px 35px rgba(22, 101, 52, 0.12); }
        .card-l2 .avatar { width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 7px; }
        .card-l2 .name { font-weight: 700; font-size: 11px; line-height: 1.3; margin-bottom: 5px; }
        .card-l2 .role-badge { font-size: 9px; font-weight: 700; text-transform: uppercase; padding: 2px 8px; border-radius: 20px; display: inline-block; }
        .card-l2 .angkatan { font-size: 9.5px; color: #94a3b8; margin-top: 3px; }
        
        .card-l2.ketua { border-color: #6ee7b7; }
        .card-l2.ketua .avatar { background: #ecfdf5; color: #059669; }
        .card-l2.ketua .role-badge { background: #ecfdf5; color: #059669; }
        .card-l2.sekretaris { border-color: #93c5fd; }
        .card-l2.sekretaris .avatar { background: #eff6ff; color: #2563eb; }
        .card-l2.sekretaris .role-badge { background: #eff6ff; color: #2563eb; }
        .card-l2.bendahara { border-color: #fca5a5; }
        .card-l2.bendahara .avatar { background: #fef2f2; color: #dc2626; }
        .card-l2.bendahara .role-badge { background: #fef2f2; color: #dc2626; }
        
        .bidang-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
        .bidang-card { background: white; border: 1.5px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: var(--card-shadow); transition: all 0.3s; }
        .bidang-card:hover { box-shadow: 0 12px 30px rgba(22, 101, 52, 0.1); transform: translateY(-3px); border-color: #a7f3d0; }
        .bidang-header { display: flex; align-items: center; gap: 12px; padding: 13px 16px; border-bottom: 1px solid #f1f5f9; }
        .bidang-header.sosial { background: #fff7ed; border-color: #fed7aa; }
        .bidang-header.organisasi { background: #f0fdf4; border-color: #86efac; }
        .bidang-header.humas { background: #eff6ff; border-color: #93c5fd; }
        .bidang-header.pendidikan { background: #fef3c7; border-color: #fde68a; }
        .bidang-icon { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
        .sosial .bidang-icon { background: #fb923c; color: white; }
        .organisasi .bidang-icon { background: #22c55e; color: white; }
        .humas .bidang-icon { background: #3b82f6; color: white; }
        .pendidikan .bidang-icon { background: #eab308; color: white; }
        .bidang-koord-name { font-weight: 800; font-size: 13px; line-height: 1.2; }
        .bidang-koord-role { font-size: 10px; color: #64748b; font-weight: 600; margin-top: 2px; }
        .bidang-body { padding: 12px 14px 14px; }
        .anggota-chips { display: flex; flex-wrap: wrap; gap: 6px; }
        .chip { display: inline-flex; align-items: center; gap: 5px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 4px 10px; font-size: 11px; font-weight: 600; color: #334155; transition: all 0.2s; }
        .chip:hover { background: #ecfdf5; border-color: var(--man-green); color: var(--man-green); }
        .chip-angkatan { font-size: 9.5px; color: #94a3b8; font-weight: 500; }
    </style>
</head>
<body>

    <!-- Navigasi Sidebar Tema MAN -->
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="bi bi-mortarboard-fill logo-icon"></i>
            <h5>Alumni Tracer</h5>
            <p>MAN 2 Yogyakarta</p>
        </div>
        <nav>
            <a href="dashboard.php" class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a href="data_alumni.php" class="nav-link <?php echo ($current_page == 'data_alumni.php') ? 'active' : ''; ?>"><i class="bi bi-people-fill"></i> Data Alumni</a>
            <a href="pengurus.php" class="nav-link <?php echo ($current_page == 'pengurus.php') ? 'active' : ''; ?>"><i class="bi bi-diagram-3-fill"></i> Pengurus</a>
            <a href="pengaturan.php" class="nav-link <?php echo ($current_page == 'pengaturan.php') ? 'active' : ''; ?>"><i class="bi bi-gear-wide-connected"></i> Pengaturan</a>
        </nav>
        <a href="logout.php" class="btn-logout"><i class="bi bi-box-arrow-right me-2"></i> Logout System</a>
    </div>