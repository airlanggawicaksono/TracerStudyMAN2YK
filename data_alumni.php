<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['no_kamandaya'])) {
    header("Location: index.php");
    exit;
}

$search = $_GET['search'] ?? '';
$sort   = $_GET['sort'] ?? 'nama'; 
$order  = $_GET['order'] ?? 'ASC'; 
$next_order = ($order == 'ASC') ? 'DESC' : 'ASC';

include 'template_header.php'; // <--- Panggil template
?>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-800 m-0 text-dark">Data Lengkap Alumni</h2>
        <?php if($_SESSION['role'] === 'admin'): ?>
            <a href="tambah_data.php" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">+ Tambah</a>
        <?php endif; ?>
    </div>

    <form action="" method="GET" class="mb-4" style="max-width: 400px;">
        <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white">
            <input type="text" name="search" class="form-control border-0 px-4" placeholder="Cari nama, alamat, atau karir..." value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-primary px-4" type="submit"><i class="bi bi-search"></i></button>
        </div>
    </form>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th>FOTO</th>
                        <th>
                            <a href="?sort=nama&order=<?php echo $next_order; ?>&search=<?php echo $search; ?>" class="sort-link">
                                NAMA / KAMANDAYA <?php if($sort == 'nama') echo ($order == 'ASC' ? '<i class="bi bi-sort-alpha-down fs-6"></i>' : '<i class="bi bi-sort-alpha-up fs-6"></i>'); ?>
                            </a>
                        </th>
                        <th class="text-center">
                            <a href="?sort=angkatan&order=<?php echo $next_order; ?>&search=<?php echo $search; ?>" class="sort-link justify-content-center">
                                ANGKATAN <?php if($sort == 'angkatan') echo ($order == 'ASC' ? '<i class="bi bi-sort-numeric-down fs-6"></i>' : '<i class="bi bi-sort-numeric-up fs-6"></i>'); ?>
                            </a>
                        </th>
                        <th>KONTAK</th>
                        <th width="20%">ALAMAT</th>
                        <th>KARIR / INSTANSI</th>
                        <?php if($_SESSION['role'] === 'admin'): ?>
                            <th class="text-center">AKSI</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = "SELECT * FROM users WHERE role = 'alumni'";
                    if($search) {
                        $s = mysqli_real_escape_string($conn, $search);
                        $sql .= " AND (nama LIKE '%$s%' OR alamat LIKE '%$s%' OR pekerjaan LIKE '%$s%' OR instansi LIKE '%$s%')";
                    }
                    $sql .= " ORDER BY $sort $order";
                    $res = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($res)):
                    ?>
                    <tr>
                        <td class="text-center text-muted fw-bold"><?php echo $no++; ?></td>
                        <td>
                            <?php if(!empty($row['foto']) && strpos($row['foto'], '.') !== false): ?>
                                <img src="uploads/<?php echo $row['foto']; ?>" class="avatar-sm">
                            <?php else: ?>
                                <div class="avatar-placeholder"><i class="bi bi-person-fill"></i></div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="fw-bold text-dark"><?php echo $row['nama']; ?></div>
                            <div class="small text-primary fw-bold"><?php echo $row['no_kamandaya']; ?></div>
                        </td>
                        <td class="text-center fw-800"><?php echo $row['angkatan']; ?></td>
                        <td>
                            <div class="fw-bold"><i class="bi bi-whatsapp text-success"></i> <?php echo $row['nomor_hp'] ?: '-'; ?></div>
                            <div class="text-muted" style="font-size: 11px;"><?php echo $row['email'] ?: '-'; ?></div>
                        </td>
                        <td>
                            <div class="text-muted" style="font-size: 11px; line-height: 1.4;">
                                <?php echo $row['alamat'] ?: '-'; ?>
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark"><?php echo $row['pekerjaan'] ?: '-'; ?></div>
                            <div class="text-muted" style="font-size: 11px;"><?php echo $row['instansi'] ?: ''; ?></div>
                        </td>
                        <?php if($_SESSION['role'] === 'admin'): ?>
                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="edit_data.php?id=<?php echo $row['id']; ?>" class="btn-action bg-warning"><i class="bi bi-pencil-square"></i></a>
                                    <a href="hapus_data.php?id=<?php echo $row['id']; ?>" class="btn-action bg-danger" onclick="return confirm('Hapus data ini?')"><i class="bi bi-trash3-fill"></i></a>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'template_footer.php'; ?>