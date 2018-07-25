<?php

require_once('core/init.php'); 
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/kelas_repository.php');
require_once('repositories/pengajar_pelajaran_repository.php');

if (!isset($_GET["id"])) {
    header("location: lihat_kelas.php");
}

$menus = get_menu();
$kelas = find_by_id($_GET["id"]);
$pengajar_pelajaran = find_all_pengajar_pelajaran();

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
                <form action="controllers/tambah_jadwal_controller.php" method="post" onsubmit="return validateForm()">
                    <input type="hidden" name="id" id="id" value="<?php echo $kelas['id'] ?>">
                    
                    <div class="detail-group">
                        <p>Nama Kelas</p>
                        <p><?php echo $kelas['nama']; ?></p>
                    </div>

                    <div class="form-group">
                        <label for="pelajaran">Pelajaran</label>
                        <select name="pelajaran" id="pelajaran">
                            <?php while ($row = mysqli_fetch_assoc($pengajar_pelajaran)) { ?>
                            <option value="<?php echo $row['id_pengajar_pelajaran']; ?>">
                                <?php $jurusan = $row["tingkat_pendidikan"] === 'SMA' ? ' '. $row['jurusan'] : ''; ?>
                                <?php echo $row['nama_pelajaran'] . ' - ' . $row['nama_pengajar'] . ' - ' . $row['tingkat_pendidikan'] . $jurusan; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select name="hari" id="hari">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" placeholder="SMAN 1 Bandung">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="jam_berakhir">Jam Berakhir</label>
                        <input type="time" name="jam_berakhir" id="jam_berakhir" placeholder="SMAN 1 Bandung">
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