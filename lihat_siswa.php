<?php

require_once('core/init.php');
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/siswa_repository.php');

$menus = get_menu();
$results = find_all_siswa();

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
                <ul class="data">
                    <ul class="data-header">
                        <li><h4>NIS</h4></li>
                        <li><h4>Nama Siswa</h4></li>
                        <li><h4>Jenis Kelamin</h4></li>
                        <li><h4>Kelas</h4></li>
                        <li><h4>Aksi</h4></li>
                    </ul>

                    <?php foreach ($results as $siswa) { ?>
                    <ul class="data-body">
                        <li><?php echo $siswa['nis']; ?></li>
                        <li><?php echo $siswa['nama_siswa']; ?></li>
                        <li><?php echo $siswa['jenis_kelamin']; ?></li>
                        <li><?php echo $siswa['nama_kelas']; ?></li>
                        <li>
                            <a href="ubah_siswa.php?nis=<?php echo $siswa['nis']; ?>" 
                                class="btn btn-data">
                                Ubah
                            </a>
                            <a href="detail_siswa.php?nis=<?php echo $siswa['nis']; ?>" 
                                class="btn btn-data">
                                Detail
                            </a>
                            <button class="btn btn-data" 
                                onclick="confirmDeletion('<?php echo $siswa['nis']; ?>')">
                                Hapus
                            </button>
                        </li>
                    </ul>
                    <?php } ?>
                </ul>
            </article>
        </section>
    </main>

    <script src="assets/js/lihat_siswa.js"></script>
</body>
</html>