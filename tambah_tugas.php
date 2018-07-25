<?php

require_once('core/init.php'); 
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/pengajar_repository.php');
require_once('repositories/pelajaran_repository.php');

if (!isset($_GET["nip"])) {
    header("location: lihat_pengajar.php");
}

$menus = get_menu();
$pengajar = find_by_nip($_GET["nip"]);
$pengajar_pelajaran = find_pelajaran_by_nip($_GET["nip"]);
$pelajaran = find_all_pelajaran();

$kode_mapel = [];
foreach ($pengajar_pelajaran as $elem) {
    array_push($kode_mapel, $elem['kode']);
}

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
    <title>Ubah Pengajar - Sistem Informasi Bimbel</title>

    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu">
                    <a href="lihat_pengajar.php">Lihat Pengajar</a>
                </li>
                <li class="side-bar-menu">
                    <a href="tambah_pengajar.php">Registrasi Pengajar</a>
                </li>
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
                <form action="controllers/tambah_tugas_controller.php" method="post" onsubmit="return validateForm()">
                    <input type="hidden" name="nip" id="nip" value="<?php echo $pengajar['nip'] ?>">
                    
                    <div class="detail-group">
                        <p>Nama Pengajar</p>
                        <p><?php echo $pengajar['nama']; ?></p>
                    </div>

                    <div class="check-group">
                        <?php while ($row = mysqli_fetch_assoc($pelajaran)) {?>
                            <input type="checkbox" 
                                name="pengajar_pelajaran[]"
                                value="<?php echo $row['kode_mapel']; ?>"
                                <?php echo in_array($row['kode_mapel'], $kode_mapel) ? 'checked' : ''; ?>> 
                            <?php $jurusan = $row['tingkat_pendidikan'] === 'SMA' ? ' ' . $row['jurusan'] : ''; ?>
                            <p><?php echo $row['nama_pelajaran'] . ' - ' . $row['tingkat_pendidikan'] . $jurusan; ?></p>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn accent-color" name="submit">
                    </div>
                </form>
            </article>
        </section>
    </main>

    <script src="assets/js/registrasi_pengajar.js"></script>
</body>

</html>