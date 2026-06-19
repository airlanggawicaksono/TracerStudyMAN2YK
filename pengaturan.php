<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['no_kamandaya'])) {
    header("Location: index.php");
    exit;
}

$id = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
$user_data = mysqli_fetch_assoc($query);

$nama_user      = $user_data['nama'] ?? 'NAMA BELUM DIATUR';
$nisn_user      = $user_data['nisn'] ?? '-';
$tgl_lahir      = $user_data['tanggal_lahir'] ?? '';
$tmpt_lahir     = $user_data['tempat_lahir'] ?? '';
$angkatan_user  = $user_data['angkatan'] ?? '-';
$alamat_user    = $user_data['alamat'] ?? '-';
$kamandaya_user = $user_data['no_kamandaya'] ?? '-';
$foto_user      = $user_data['foto'] ?? '';

include 'template_header.php'; // <--- Panggil template
?>

<div class="main-content">
    <h2 class="fw-800 mb-4 text-dark">Profil Saya</h2>

    <div class="id-card">
        <div class="card-header-green">
            <div class="header-content">
                <h6>KELUARGA ALUMNI MAN 2 YOGYAKARTA</h6>
                <p>JL. KH. AHMAD DAHLAN NO.130, NGAMPILAN, KOTA YOGYAKARTA</p>
                <p>website: man2yogyakarta.sch.id | No. Telp: (0274) 513347</p>
            </div>
        </div>

        <div class="card-body-content">
            <div class="photo-section">
                <?php 
                if(!empty($foto_user) && file_exists("uploads/" . $foto_user)){
                    echo '<img src="uploads/' . $foto_user . '" alt="Foto Profil">';
                } else {
                    echo '<div class="d-flex align-items-center justify-content-center h-100 text-white opacity-25"><i class="bi bi-person-fill" style="font-size: 8rem;"></i></div>';
                }
                ?>
            </div>

            <div class="info-section">
                <h4>ALUMNI SMART CARD</h4>
                <div class="data-row"><span class="data-label">NAMA</span> <span>:</span> <span class="fw-bold"><?php echo strtoupper($nama_user); ?></span></div>
                <div class="data-row"><span class="data-label">NISN</span> <span>:</span> <span><?php echo $nisn_user; ?></span></div>
                <div class="data-row"><span class="data-label">TTL</span> <span>:</span> <span><?php echo strtoupper($tmpt_lahir); ?>, <?php echo strtoupper(date('d F Y', strtotime($tgl_lahir))); ?></span></div>
                <div class="data-row"><span class="data-label">ANGKATAN</span> <span>:</span> <span><?php echo $angkatan_user; ?></span></div>
                <div class="data-row"><span class="data-label">ALAMAT</span> <span>:</span> <span style="font-size: 13px;"><?php echo strtoupper($alamat_user); ?></span></div>
                <div class="data-row mt-3"><span class="data-label">KAMANDAYA</span> <span>:</span> <span class="fw-bold text-primary"><?php echo $kamandaya_user; ?></span></div>
            </div>
        </div>
        <div class="card-footer-green"></div>
    </div>

    <div class="edit-room">
        <h5 class="fw-800 mb-4 text-dark">Lengkapi Profil Alumni</h5>
        <form action="update_aksi.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">
            
            <div class="row g-4">
                <div class="col-md-12 mb-2">
                    <label class="form-label">Update Foto Profil</label>
                    <div class="upload-area p-3 border border-2 border-primary border-dashed rounded text-center" style="cursor:pointer; background:#eff6ff;" onclick="document.getElementById('fotoInput').click();">
                        <i class="bi bi-cloud-arrow-up h2 text-primary"></i>
                        <p class="small text-muted mb-0">Klik untuk pilih foto (JPG, PNG, Max 2MB)</p>
                        <input type="file" name="foto" id="fotoInput" hidden accept="image/*">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($user_data['nama'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">NISN</label>
                    <input type="text" name="nisn" class="form-control" value="<?php echo htmlspecialchars($user_data['nisn'] ?? ''); ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nomor WhatsApp</label>
                    <input type="text" name="nomor_hp" class="form-control" value="<?php echo htmlspecialchars($user_data['nomor_hp'] ?? ''); ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user_data['email'] ?? ''); ?>" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="<?php echo htmlspecialchars($user_data['tempat_lahir'] ?? ''); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo htmlspecialchars($user_data['tanggal_lahir'] ?? ''); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Angkatan</label>
                    <input type="number" name="angkatan" class="form-control" value="<?php echo htmlspecialchars($user_data['angkatan'] ?? ''); ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pekerjaan / Jabatan</label>
                    <input type="text" name="pekerjaan" class="form-control" value="<?php echo htmlspecialchars($user_data['pekerjaan'] ?? ''); ?>" placeholder="Cth: Direktur / Mahasiswa Teknik">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Instansi / Kampus</label>
                    <input type="text" name="instansi" class="form-control" value="<?php echo htmlspecialchars($user_data['instansi'] ?? ''); ?>" placeholder="Cth: Pertamina / UGM">
                </div>

                <div class="col-12">
                    <label class="form-label">Alamat Domisili Sekarang</label>
                    <textarea name="alamat" class="form-control" rows="3"><?php echo htmlspecialchars($user_data['alamat'] ?? ''); ?></textarea>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn-update">
                        <i class="bi bi-check2-circle me-2"></i> Simpan Perubahan Profil
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'template_footer.php'; ?>