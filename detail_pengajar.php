<?php

require_once('core/init.php');
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/pengajar_repository.php');

if (!isset($_GET["nip"])) {
    header("location: lihat_pengajar.php");
}

$menus = get_menu();
$pengajar = find_by_nip($_GET["nip"]);
$pelajaran = find_pelajaran_by_nip($_GET["nip"]);

if ($pengajar === []) {
    header("location: lihat_pengajar.php");
}

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
                                <a href="<?php echo $menu['link'] ?>" class="<?php echo $menu['judul'] === 'Pengajar' ? 'active' : ''; ?>">
                                    <?php echo $menu['judul']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </header>

            <article>
                <div class="detail-group">
                    <p>NIP</p>
                    <p><?php echo $pengajar['nip']; ?></p>
                </div>
                
                <div class="detail-group">
                    <p>Nama Pengajar</p>
                    <p><?php echo $pengajar['nama']; ?></p>
                </div>

                <div class="detail-group">
                    <p>Tanggal Lahir</p>
                    <p><?php echo $pengajar['ttl']; ?></p>
                </div>

                <div class="detail-group">
                    <p>Jenip Kelamin</p>
                    <p><?php echo $pengajar['jk']; ?></p>
                </div>
                
                <div class="detail-group">
                    <p>No Telepon</p>
                    <p><?php echo $pengajar['notelp']; ?></p>
                </div>

                <div class="detail-group">
                    <p>Pelajaran</p>
                    <ol>
                        <?php foreach ($pelajaran as $row) { ?>
                            <?php $jurusan = $row['jurusan'] ? ' ' . $row['jurusan'] : ''; ?>
                            <li><?php echo $row['nama'] . ' - '. $row['pendidikan'] . $jurusan;?></li>
                        <?php } ?>
                    </ol>
                </div>

                <div class="detail-group">
                    <a class="btn accent-color" href="ubah_pengajar.php?nip=<?php echo $pengajar['nip']; ?>">Ubah</a>
                    <a style="margin-left: 8px;" class="btn accent-color" href="tambah_tugas.php?nip=<?php echo $pengajar['nip']; ?>">
                        Tambah Tugas
                    </a>
                    <button style="margin-left: 8px;" 
                        class="btn accent-color" 
                        onclick="confirmDeletion('<?php echo $pengajar['nip']; ?>')">
                        Hapus
                    </button>
                </div>
            </article>
        </section>
    </main>

    <script src="assets/js/lihat_pengajar.js"></script>
</body>
</html>