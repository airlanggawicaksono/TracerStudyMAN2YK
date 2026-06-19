<?php
session_start();
// Baris ini membiarkan halaman pengurus bisa dilihat sebagai preview meskipun belum login
$_SESSION['no_kamandaya'] = 'preview'; 

include 'template_header.php'; // <--- Memanggil CSS dan Sidebar
?>

<div class="main-content">
    <div class="header-title">
        <h2>Struktur Organisasi 2025</h2>
        <p class="text-muted">Bagan Kepengurusan Keluarga Alumni MAN 2 Yogyakarta</p>
    </div>

    <!-- ===== PENASIHAT ===== -->
    <div class="section-label"><i class="bi bi-shield-star"></i> Dewan Penasihat</div>
    <div class="penasihat-row">
        <div class="card-penasihat">
            <div class="avatar"><i class="bi bi-building"></i></div>
            <div class="name">Kepala Madrasah</div>
            <div class="role-badge">Penasihat</div>
        </div>
        <div class="card-penasihat">
            <div class="avatar"><i class="bi bi-person-fill"></i></div>
            <div class="name">Dr. Mustofa Anshori Lidinillah, M.Hum</div>
            <div class="role-badge">Penasihat</div>
            <div class="angkatan">1985</div>
        </div>
        <div class="card-penasihat">
            <div class="avatar"><i class="bi bi-person-fill"></i></div>
            <div class="name">Dr. Trias Setiawati</div>
            <div class="role-badge">Penasihat</div>
            <div class="angkatan">1985</div>
        </div>
        <div class="card-penasihat">
            <div class="avatar"><i class="bi bi-person-fill"></i></div>
            <div class="name">Drs. H. Gatot Mujiaono</div>
            <div class="role-badge">Penasihat</div>
            <div class="angkatan">1985</div>
        </div>
        <div class="card-penasihat">
            <div class="avatar"><i class="bi bi-person-fill"></i></div>
            <div class="name">Dra. Ening Yuni, M.Pd</div>
            <div class="role-badge">Penasihat</div>
            <div class="angkatan">1985</div>
        </div>
        <div class="card-penasihat">
            <div class="avatar"><i class="bi bi-person-fill"></i></div>
            <div class="name">Sri Rahayu</div>
            <div class="role-badge">Penasihat</div>
            <div class="angkatan">1985</div>
        </div>
        <div class="card-penasihat">
            <div class="avatar"><i class="bi bi-person-fill"></i></div>
            <div class="name">Sumiyati</div>
            <div class="role-badge">Penasihat</div>
            <div class="angkatan">1985</div>
        </div>
        <div class="card-penasihat">
            <div class="avatar"><i class="bi bi-person-fill"></i></div>
            <div class="name">Rahmadiono</div>
            <div class="role-badge">Penasihat</div>
            <div class="angkatan">1987</div>
        </div>
    </div>

    <!-- Connector -->
    <div class="v-line mt-1"></div>

    <!-- ===== KETUA UMUM ===== -->
    <div class="d-flex justify-content-center">
        <div class="card-ketua-umum">
            <div class="avatar"><i class="bi bi-person-badge-fill"></i></div>
            <div class="name">Dyah Estuti Tri H, S.Pd</div>
            <div class="role-badge">Ketua Umum</div>
            <div class="angkatan">1994</div>
        </div>
    </div>

    <!-- Connector + horizontal bar -->
    <div class="v-line"></div>
    <div class="h-bar" style="max-width:900px; margin:0 auto;"></div>

    <!-- ===== LEVEL 2 ===== -->
    <div style="max-width:1150px; margin:0 auto;">
        <div class="level2-container">
            <div class="level2-hline"></div>

            <!-- Ketua 1 -->
            <div class="level2-col">
                <div class="v-line"></div>
                <div class="card-l2 ketua">
                    <div class="avatar"><i class="bi bi-person-fill"></i></div>
                    <div class="name">Muhammad Oriza NurFajri, S.Kom, M.Si</div>
                    <div class="role-badge">Ketua 1</div>
                    <div class="angkatan">2009</div>
                </div>
            </div>
            <!-- Ketua 2 -->
            <div class="level2-col">
                <div class="v-line"></div>
                <div class="card-l2 ketua">
                    <div class="avatar"><i class="bi bi-person-fill"></i></div>
                    <div class="name">Harya Rifky Pratama</div>
                    <div class="role-badge">Ketua 2</div>
                    <div class="angkatan">2014</div>
                </div>
            </div>
            <!-- Ketua 3 -->
            <div class="level2-col">
                <div class="v-line"></div>
                <div class="card-l2 ketua">
                    <div class="avatar"><i class="bi bi-person-fill"></i></div>
                    <div class="name">Muhammad Rifa'at Adiakarta</div>
                    <div class="role-badge">Ketua 3</div>
                    <div class="angkatan">2012</div>
                </div>
            </div>
            <!-- Sekretaris 1 -->
            <div class="level2-col">
                <div class="v-line"></div>
                <div class="card-l2 sekretaris">
                    <div class="avatar"><i class="bi bi-file-text-fill"></i></div>
                    <div class="name">Gayatri Novalinda</div>
                    <div class="role-badge">Sekretaris 1</div>
                    <div class="angkatan">2015</div>
                </div>
            </div>
            <!-- Sekretaris 2 -->
            <div class="level2-col">
                <div class="v-line"></div>
                <div class="card-l2 sekretaris">
                    <div class="avatar"><i class="bi bi-file-text-fill"></i></div>
                    <div class="name">Ayunda Hanifah</div>
                    <div class="role-badge">Sekretaris 2</div>
                    <div class="angkatan">2009</div>
                </div>
            </div>
            <!-- Bendahara 1 -->
            <div class="level2-col">
                <div class="v-line"></div>
                <div class="card-l2 bendahara">
                    <div class="avatar"><i class="bi bi-cash-stack"></i></div>
                    <div class="name">Erni Purwaningsih, S.Pd</div>
                    <div class="role-badge">Bendahara 1</div>
                    <div class="angkatan">1992</div>
                </div>
            </div>
            <!-- Bendahara 2 -->
            <div class="level2-col">
                <div class="v-line"></div>
                <div class="card-l2 bendahara">
                    <div class="avatar"><i class="bi bi-cash-stack"></i></div>
                    <div class="name">Neilindari Meinarlin</div>
                    <div class="role-badge">Bendahara 2</div>
                    <div class="angkatan">1994</div>
                </div>
            </div>

        </div>
    </div>

    <hr class="section-divider">

    <!-- ===== BIDANG ===== -->
    <div class="section-label"><i class="bi bi-people-fill"></i> Koordinator Bidang &amp; Anggota</div>
    <div class="bidang-grid">

        <!-- SOSIAL -->
        <div class="bidang-card">
            <div class="bidang-header sosial">
                <div class="bidang-icon"><i class="bi bi-heart-fill"></i></div>
                <div>
                    <div class="bidang-koord-name">Zaid Muhammad Abudzar</div>
                    <div class="bidang-koord-role">Koord. Sosial Kemasyarakatan &bull; 2019</div>
                </div>
            </div>
            <div class="bidang-body">
                <div class="anggota-chips">
                    <span class="chip"><i class="bi bi-person-fill"></i> Edwi Mintarjo <span class="chip-angkatan">1994</span></span>
                    <span class="chip"><i class="bi bi-person-fill"></i> Hasan <span class="chip-angkatan">2019</span></span>
                </div>
            </div>
        </div>

        <!-- ORGANISASI -->
        <div class="bidang-card">
            <div class="bidang-header organisasi">
                <div class="bidang-icon"><i class="bi bi-diagram-2-fill"></i></div>
                <div>
                    <div class="bidang-koord-name">Mohammad Qosim, S.Pd.I, Gr, M.S.I</div>
                    <div class="bidang-koord-role">Koord. Organisasi &amp; Pemberdayaan &bull; 2013</div>
                </div>
            </div>
            <div class="bidang-body">
                <div class="anggota-chips">
                    <span class="chip"><i class="bi bi-person-fill"></i> Fahmi Idris <span class="chip-angkatan">2012</span></span>
                    <span class="chip"><i class="bi bi-person-fill"></i> Putri Susilowati <span class="chip-angkatan">2012</span></span>
                    <span class="chip"><i class="bi bi-person-fill"></i> Syafiq Hamzah <span class="chip-angkatan">2017</span></span>
                </div>
            </div>
        </div>

        <!-- HUMAS -->
        <div class="bidang-card">
            <div class="bidang-header humas">
                <div class="bidang-icon"><i class="bi bi-megaphone-fill"></i></div>
                <div>
                    <div class="bidang-koord-name">Muhammad Nurcahyo Agung Pambudi</div>
                    <div class="bidang-koord-role">Koord. Humas, Media &amp; Publikasi &bull; 2016</div>
                </div>
            </div>
            <div class="bidang-body">
                <div class="anggota-chips">
                    <span class="chip"><i class="bi bi-person-fill"></i> Kurnia Ikhlasul Amal <span class="chip-angkatan">2016</span></span>
                    <span class="chip"><i class="bi bi-person-fill"></i> Tri Nurhabibi <span class="chip-angkatan">2015</span></span>
                    <span class="chip"><i class="bi bi-person-fill"></i> Agatha Reyzky Permata <span class="chip-angkatan">2012</span></span>
                    <span class="chip"><i class="bi bi-person-fill"></i> Sumarno <span class="chip-angkatan">2012</span></span>
                    <span class="chip"><i class="bi bi-person-fill"></i> Siska <span class="chip-angkatan">1999</span></span>
                </div>
            </div>
        </div>

        <!-- PENDIDIKAN -->
        <div class="bidang-card">
            <div class="bidang-header pendidikan">
                <div class="bidang-icon"><i class="bi bi-book-fill"></i></div>
                <div>
                    <div class="bidang-koord-name">Muhammad Happy Al Haq, S.Pd.Gr</div>
                    <div class="bidang-koord-role">Koord. Pendidikan &amp; Ilmiah &bull; 2018</div>
                </div>
            </div>
            <div class="bidang-body">
                <div class="anggota-chips">
                    <span class="chip"><i class="bi bi-person-fill"></i> Edward <span class="chip-angkatan">2014</span></span>
                    <span class="chip"><i class="bi bi-person-fill"></i> Rohmat Bekti Nugroho <span class="chip-angkatan">2002</span></span>
                    <span class="chip"><i class="bi bi-person-fill"></i> Ahmad Afandi <span class="chip-angkatan">2004</span></span>
                    <span class="chip"><i class="bi bi-person-fill"></i> Siti Nurul Hidayah <span class="chip-angkatan">1993</span></span>
                    <span class="chip"><i class="bi bi-person-fill"></i> Tri Kuncoro <span class="chip-angkatan">2009</span></span>
                </div>
            </div>
        </div>

    </div><!-- end bidang-grid -->

</div><!-- end main-content -->

<?php include 'template_footer.php'; ?> // <--- Memanggil penutup HTML dan Javascript Bootrstrap