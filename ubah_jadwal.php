<?php

require_once('core/init.php'); 
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/jadwal_kelas_repository.php');

if (!isset($_GET["id"])) {
    header("location: lihat_jadwal.php?id=".$_GET['kelas']);
}

$menus = get_menu();
$jadwal = find_jadwal_by_id_jadwal($_GET["id"]);

if ($jadwal === []) {
    header("location: lihat_jadwal.php?id=".$_GET['kelas']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Jadwal - Sistem Informasi Bimbel</title>

    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu">
                    <a href="lihat_kelas.php">Lihat Kelas</a>
                </li>
                <li class="side-bar-menu">
                    <a href="tambah_kelas.php">Tambah Kelas</a>
                </li>
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
                <form action="controllers/ubah_jadwal_controller.php" method="post" onsubmit="return validateForm()">
                    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>">
                    <input type="hidden" name="id_kelas" id="id_kelas" value="<?php echo $_GET['kelas'] ?>">
                    
                    <div class="detail-group">
                        <p>Nama Kelas</p>
                        <p><?php echo $jadwal['nama_kelas']; ?></p>
                    </div>

                    <div class="detail-group">
                        <p>Nama Pelajaran</p>
                        <p>
                            <?php $jurusan = $jadwal["pendidikan"] === 'SMA' ? ' '. $jadwal['jurusan'] : ''; ?>
                            <?php echo $jadwal['nama_pelajaran'] . ' - ' . $jadwal['pengajar'] . ' - ' . $jadwal['pendidikan'] . $jurusan; ?>
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select name="hari" id="hari">
                            <option value="Senin" <?php echo $jadwal['hari'] === 'Senin' ? 'selected' : '' ?>>Senin</option>
                            <option value="Selasa" <?php echo $jadwal['hari'] === 'Selasa' ? 'selected' : '' ?>>Selasa</option>
                            <option value="Rabu" <?php echo $jadwal['hari'] === 'Rabu' ? 'selected' : '' ?>>Rabu</option>
                            <option value="Kamis" <?php echo $jadwal['hari'] === 'Kamis' ? 'selected' : '' ?>>Kamis</option>
                            <option value="Jumat" <?php echo $jadwal['hari'] === 'Jumat' ? 'selected' : '' ?>>Jumat</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" 
                            name="jam_mulai" 
                            id="jam_mulai" 
                            value="<?php echo $jadwal['jam_mulai'] ?>"
                            placeholder="SMAN 1 Bandung">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="jam_berakhir">Jam Berakhir</label>
                        <input type="time" 
                            name="jam_berakhir" 
                            id="jam_berakhir" 
                            value="<?php echo $jadwal['jam_berakhir'] ?>"
                            placeholder="SMAN 1 Bandung">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn accent-color" name="submit">
                    </div>
                </form>
            </article>
        </section>
    </main>

    <script src="assets/js/tambah_jadwal.js"></script>
</body>

</html>