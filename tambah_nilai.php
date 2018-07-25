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
$pelajaran = find_pelajaran_by_nis($_GET["nis"]);

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
                <form action="controllers/tambah_nilai_controller.php" method="post" onsubmit="return validateForm()">
                    <input type="hidden" name="nis" id="nis" value="<?php echo $_GET["nis"]; ?>">
                            
                    <div class="detail-group">
                        <p>Nama Siswa</p>
                        <p><?php echo $siswa['nama']; ?></p>
                    </div>

                    <div class="detail-group">
                        <p>Nama Kelas</p>
                        <p><?php echo $siswa['nama_kelas']; ?></p>
                    </div>

                    <div class="form-group">
                        <label for="pelajaran">Pelajaran</label>
                        <select name="pelajaran" id="pelajaran">
                            <?php foreach($pelajaran as $elem) { ?>
                            <option value="<?php echo $elem['id_pengajar_pelajaran']; ?>">
                                <?php $jurusan = $elem["pendidikan"] === 'SMA' ? ' '. $elem['jurusan'] : ''; ?>
                                <?php echo $elem['nama_pelajaran'] . ' - ' . $elem['nama_pengajar'] . ' - ' . $elem['pendidikan'] . $jurusan; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nilai">Nilai</label>
                        <input type="text" name="nilai" id="nilai" placeholder="87">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" placeholder="Nilai Akhir">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn accent-color" name="submit">
                    </div>
                </form>
            </article>
        </section>
    </main>

    <script src="assets/js/tambah_nilai.js"></script>
</body>
</html>