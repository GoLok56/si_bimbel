<?php

require_once('core/init.php'); 
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/pelajaran_repository.php');

if (!isset($_GET["kode"])) {
    header("location: lihat_pelajaran.php");
}

$menus = get_menu();
$pelajaran = find_by_kode($_GET["kode"]);

if ($pelajaran === []) {
    header("location: lihat_pelajaran.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Pelajaran - Sistem Informasi Bimbel</title>

    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu">
                    <a href="lihat_pelajaran.php">Lihat Pelajaran</a>
                </li>
                <li class="side-bar-menu">
                    <a href="tambah_pelajaran.php">Tambah Pelajaran</a>
                </li>
            </ul>
        </sidebar>

        <section class="column flex fg-1">
            <header>
                <nav class="nav-bar primary-color flex">
                    <ul class="flex">
                        <?php foreach ($menus as $menu) { ?>
                        <li class="nav-menu">
                            <a href="<?php echo $menu['link'] ?>" class="<?php echo $menu['judul'] === 'Pelajaran' ? 'active' : ''; ?>">
                                <?php echo $menu['judul']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </header>

            <article>
                <form action="controllers/update_pelajaran_controller.php" method="post" onsubmit="return validateForm()">
                    <input type="hidden" name="kode_lama" id="kode_lama" value="<?php echo $pelajaran['kode']; ?>">        
                    <div class="form-group">
                        <label for="kode_pelajaran">Kode Pelajaran</label>
                        <input type="text" name="kode_pelajaran" id="kode_pelajaran" placeholder="SMA101" maxlength="6" value="<?php echo $pelajaran['kode']; ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="nama_pelajaran">Nama Pelajaran</label>
                        <input type="text" name="nama_pelajaran" id="nama_pelajaran" placeholder="Matematika" value="<?php echo $pelajaran['nama']; ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="tingkat_pendidikan">Pendidikan</label>
                        <select name="tingkat_pendidikan" id="tingkat_pendidikan" onchange="onPendidikanChanged(this.value)">
                            <option value="SMA" <?php echo $pelajaran["pendidikan"] === "SMA" ? "selected" : ""; ?>>SMA</option>
                            <option value="SMP" <?php echo $pelajaran["pendidikan"] === "SMP" ? "selected" : ""; ?>>SMP</option>
                            <option value="SD" <?php echo $pelajaran["pendidikan"] === "SD" ? "selected" : ""; ?>>SD</option>
                        </select>
                    </div>

                    <div class="form-group" id="jurusan">
                        <label for="jurusan">Jurusan</label>
                        <select name="jurusan" id="jurusan">
                            <option value="IPA">IPA</option>
                            <option value="IPS">IPS</option>
                            <option value="Bahasa">Bahasa</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn accent-color" name="submit">
                    </div>
                </form>

                <?php if (isset($_SESSION['sukses']) && $_SESSION['sukses'] === 1) { ?>
                    <p class="success">Berhasil merubah mata pelajaran</p>
                    <?php $_SESSION['sukses'] = 0; ?>
                <?php } ?>
            </article>
        </section>
    </main>

    <script src="assets/js/tambah_pelajaran.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectPendidikan = document.querySelector("#tingkat_pendidikan")
            onPendidikanChanged(selectPendidikan.value)
        });
    </script>
</body>

</html>