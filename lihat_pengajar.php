<?php

require_once('core/init.php');
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/pengajar_repository.php');

$menus = get_menu();
$results = find_all_pengajar();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengajar - Sistem Informasi Bimbel</title>
    
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu"><a href="lihat_pengajar.php">Lihat Pengajar</a></li>
                <li class="side-bar-menu"><a href="registrasi_pengajar.php">Registrasi Pengajar</a></li>
            </ul>
        </sidebar>

        <section class="column flex fg-1">
            <header>
                <nav class="nav-bar primary-color flex">
                    <ul class="flex">
                        <?php foreach ($menus as $menu) { ?>
                            <li class="nav-menu">
                                <a href="<?php echo $menu['link'] ?>" class="<?php echo $menu['judul'] === 'pengajar' ? 'active' : ''; ?>">
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
                        <li><h4>NIP</h4></li>
                        <li><h4>Nama Pengajar</h4></li>
                        <li><h4>Jenis Kelamin</h4></li>
                        <li><h4>No Telepon</h4></li>
                        <li><h4>Aksi</h4></li>
                    </ul>

                    <?php foreach ($results as $pengajar) { ?>
                    <ul class="data-body">
                        <li><?php echo $pengajar['nip']; ?></li>
                        <li><?php echo $pengajar['nama_pengajar']; ?></li>
                        <li><?php echo $pengajar['jenis_kelamin']; ?></li>
                        <li><?php echo $pengajar['no_telepon']; ?></li>
                        <li>
                            <a href="ubah_pengajar.php?nip=<?php echo $pengajar['nip']; ?>" 
                                class="btn btn-data">
                                Ubah
                            </a>
                            <a href="detail_pengajar.php?nip=<?php echo $pengajar['nip']; ?>" 
                                class="btn btn-data">
                                Detail
                            </a>
                            <button class="btn btn-data" 
                                onclick="confirmDeletion('<?php echo $pengajar['nip']; ?>')">
                                Hapus
                            </button>
                        </li>
                    </ul>
                    <?php } ?>
                </ul>
            </article>
        </section>
    </main>

    <script src="assets/js/lihat_pengajar.js"></script>
</body>
</html>