<?php

require_once('core/init.php');
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/kelas_repository.php');

$menus = get_menu();
$results = find_all_kelas();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelas - Sistem Informasi Bimbel</title>
    
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu"><a href="lihat_kelas.php">Lihat Kelas</a></li>
                <li class="side-bar-menu"><a href="tambah_kelas.php">Tambah Kelas</a></li>
            </ul>
        </sidebar>

        <section class="column flex fg-1">
            <header>
                <nav class="nav-bar primary-color flex">
                    <ul class="flex">
                        <?php foreach ($menus as $menu) { ?>
                            <li class="nav-menu">
                                <a href="<?php echo $menu['link'] ?>" class="<?php echo $menu['judul'] === 'Kelas' ? 'active' : ''; ?>">
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
                        <li><h4>Id Kelas</h4></li>
                        <li><h4>Nama Kelas</h4></li>
                        <li><h4>Aksi</h4></li>
                    </ul>

                    <?php foreach ($results as $kelas) { ?>
                    <ul class="data-body">
                        <li><?php echo $kelas['id_kelas']; ?></li>
                        <li><?php echo $kelas['nama_kelas']; ?></li>
                        <li>
                            <a href="ubah_kelas.php?id=<?php echo $kelas['id_kelas']; ?>" 
                                class="btn btn-data">
                                Ubah
                            </a>
                            <a href="lihat_jadwal.php?id=<?php echo $kelas['id_kelas']; ?>" 
                                class="btn btn-data">
                                Jadwal
                            </a>
                            <button class="btn btn-data" 
                                onclick="confirmDeletion('<?php echo $kelas['id_kelas']; ?>')">
                                Hapus
                            </button>
                        </li>
                    </ul>
                    <?php } ?>
                </ul>
            </article>
        </section>
    </main>

    <script src="assets/js/lihat_kelas.js"></script>
</body>
</html>