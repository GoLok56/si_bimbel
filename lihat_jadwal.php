<?php

require_once('core/init.php');
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/kelas_repository.php');


if (!isset($_GET["id"])) {
    header("location: lihat_kelas.php");
}

$menus = get_menu();
$kelas = find_by_id($_GET['id']);
$jadwal = find_jadwal_by_id($_GET["id"]);

if ($kelas === []) {
    header("location: lihat_kelas.php");
}

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
                <h3>Jadwal Kelas <?php echo $kelas['nama']; ?></h3>
                <ul class="data">
                    <ul class="data-header">
                        <li><h4>Hari</h4></li>
                        <li><h4>Jam Mulai</h4></li>
                        <li><h4>Jam Berakhir</h4></li>
                        <li><h4>Nama Pelajaran</h4></li>
                        <li><h4>Pengajar</h4></li>
                        <li><h4>Pendidikan</h4></li>
                        <li><h4>Jurusan</h4></li>
                        <li><h4>Aksi</h4></li>
                    </ul>

                    <?php if ($jadwal === []) { ?>
                        <ul class="data-body">
                            <li>-</li>
                            <li>-</li>
                            <li>-</li>
                            <li>-</li>
                            <li>-</li>
                            <li>-</li>
                            <li>-</li>
                            <li>-</li>
                        </ul>
                    <?php } ?>
                    <?php foreach ($jadwal as $elem) { ?>
                    <ul class="data-body">
                        <li><?php echo $elem['hari']; ?></li>
                        <li><?php echo $elem['jam_mulai']; ?></li>
                        <li><?php echo $elem['jam_berakhir']; ?></li>
                        <li><?php echo $elem['nama_pelajaran']; ?></li>
                        <li><?php echo $elem['pengajar']; ?></li>
                        <li><?php echo $elem['pendidikan']; ?></li>
                        <li><?php echo $elem['jurusan']; ?></li>
                        <li>
                            <a href="ubah_jadwal.php?id=<?php echo $elem['id_jadwal']; ?>&kelas=<?php echo $kelas['id']; ?>" 
                                class="btn btn-data">
                                Ubah
                            </a>
                            <button class="btn btn-data" 
                                onclick="confirmDeletion('<?php echo $elem['id_jadwal']; ?>', '<?php echo $kelas['id']; ?>')">
                                Hapus
                            </button>
                        </li>
                    </ul>
                    <?php } ?>
                </ul>
                <a class="btn accent-color" 
                    href="tambah_jadwal.php?id=<?php echo $kelas['id']; ?>">Tambah Jadwal</a>
            </article>
        </section>
    </main>

    <script src="assets/js/lihat_jadwal.js"></script>
</body>
</html>