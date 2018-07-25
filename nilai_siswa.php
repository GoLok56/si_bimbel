<?php

require_once('core/init.php');
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/siswa_repository.php');

if (!isset($_GET["nis"])) {
    header("location: lihat_siswa.php");
}

$menus = get_menu();
$siswa = find_by_nis($_GET['nis']);
$pelajaran = find_pelajaran_by_nis($_GET['nis']);

if ($siswa === []) {
    header("location: lihat_siswa.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Siswa - Sistem Informasi Bimbel</title>
    
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu"><a href="lihat_siswa.php">Lihat Siswa</a></li>
                <li class="side-bar-menu"><a href="registrasi_siswa.php">Registrasi Siswa</a></li>
            </ul>
        </sidebar>

        <section class="column flex fg-1">
            <header>
                <nav class="nav-bar primary-color flex">
                    <ul class="flex">
                        <?php foreach ($menus as $menu) { ?>
                            <li class="nav-menu">
                                <a href="<?php echo $menu['link'] ?>" class="<?php echo $menu['judul'] === 'Siswa' ? 'active' : ''; ?>">
                                    <?php echo $menu['judul']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </header>

            <article>
                <div class="detail-group">
                    <p>Nama Siswa</p>
                    <p><?php echo $siswa['nama']; ?></p>
                </div>

                <div class="detail-group">
                    <p>Nama Kelas</p>
                    <p><?php echo $siswa['nama_kelas']; ?></p>
                </div>

                <div class="detail-group">
                    <p>Nilai</p>
                    <ol>
                        <?php foreach ($pelajaran as $row) { ?>
                            <li>
                                <div>
                                    <?php echo $row['nama_pelajaran'] . '<br>';  ?>
                                    <?php $nilai = find_nilai_by_nis_and_id($row['id_pengajar_pelajaran'], $siswa['nis']); ?>
                                    <?php foreach ($nilai as $n) { ?>
                                        <div style='margin-top: 4px;'>
                                            <?php echo $n['nilai'] . ' - ' . $n['keterangan']; ?>
                                            <a style="margin-left: 8px;" class="btn accent-color" href="ubah_nilai.php?id=<?php echo $n['id']; ?>&nis=<?php echo $siswa['nis']; ?>">
                                                Ubah
                                            </a>
                                            <button style="margin-left: 8px;" 
                                                class="btn accent-color" 
                                                onclick="confirmDeletion('<?php echo $n['id']; ?>', '<?php echo $siswa['nis']; ?>')">
                                                Hapus
                                            </button> <br>
                                        </div>
                                    <?php } ?>
                                </div>
                            </li>
                        <?php } ?>
                    </ol>
                </div>

                <div class="detail-group">
                    <a class="btn accent-color" 
                        href="tambah_nilai.php?nis=<?php echo $siswa['nis']; ?>">
                        Tambah Nilai
                    </a>
                </div>
            </article>
        </section>
    </main>

    <script src="assets/js/nilai_siswa.js"></script>
</body>
</html>