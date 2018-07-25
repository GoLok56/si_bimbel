<?php

require_once('core/init.php'); 
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/siswa_repository.php');
require_once('repositories/kelas_repository.php');

if (!isset($_GET["nis"])) {
    header("location: lihat_siswa.php");
}

$menus = get_menu();
$siswa = find_by_nis($_GET["nis"]);

if ($siswa === []) {
    header("location: lihat_siswa.php");
}

$result = find_all_kelas();

$kelasList = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($kelasList, [
        "id" => $row["id_kelas"],
        "nama" => $row["nama_kelas"]
    ]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah siswa - Sistem Informasi Bimbel</title>

    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu">
                    <a href="lihat_siswa.php">Lihat Siswa</a>
                </li>
                <li class="side-bar-menu">
                    <a href="registrasi_siswa.php">Registrasi Siswa</a>
                </li>
            </ul>
        </sidebar>

        <section class="column flex fg-1">
            <header>
                <nav class="nav-bar primary-color flex">
                    <ul class="flex">
                        <?php foreach ($menus as $menu) { ?>
                        <li class="nav-menu">
                            <a href="<?php echo $menu['link'] ?>" class="<?php echo $menu['judul'] === 'siswa' ? 'active' : ''; ?>">
                                <?php echo $menu['judul']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </header>

            <article>
                <form action="controllers/update_siswa_controller.php" method="post" onsubmit="return validateForm()">
                    <input type="hidden" name="nis_lama" id="nis_lama" value="<?php echo $siswa['nis'] ?>">

                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" 
                            name="nis" id="nis" 
                            placeholder="9983430001" 
                            maxlength="10"
                            value="<?php echo $siswa["nis"] ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" 
                            name="nama" id="nama" 
                            placeholder="Budi Taher"
                            value="<?php echo $siswa["nama"] ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="radio" 
                            name="jenis_kelamin" 
                            id="jenis_kelamin" 
                            value="Laki-laki" 
                            <?php echo $siswa["jk"] === "Laki-laki" ? 'checked' : '' ?>> Laki-laki
                        <input type="radio" 
                            name="jenis_kelamin" 
                            id="jenis_kelamin" 
                            value="Perempuan"
                            <?php echo $siswa["jk"] === "Perempuan" ? 'checked' : '' ?>> Perempuan
                    </div>

                    <div class="form-group">
                        <label for="tingkat_pendidikan">Pendidikan</label>
                        <select name="tingkat_pendidikan" id="tingkat_pendidikan">
                            <option value="sma" <?php echo $siswa["pendidikan"] === "SMA" ? 'selected' : '' ?>>SMA</option>
                            <option value="smp" <?php echo $siswa["pendidikan"] === "SMP" ? 'selected' : '' ?>>SMP</option>
                            <option value="sd" <?php echo $siswa["pendidikan"] === "SD" ? 'selected' : '' ?>>SD</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="asal_sekolah">Asal Sekolah</label>
                        <input type="text" 
                            name="asal_sekolah" 
                            id="asal_sekolah" 
                            placeholder="SMAN 1 Bandung"
                            value="<?php echo $siswa["asal_sekolah"] ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" 
                            name="tanggal_lahir" 
                            id="tanggal_lahir"
                            value="<?php echo $siswa["ttl"] ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <input type="text" 
                            name="no_telepon" 
                            id="no_telepon" 
                            placeholder="085681480083"
                            value="<?php echo $siswa["notelp"] ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas">
                            <?php foreach ($kelasList as $kelas) { ?>
                            <option value="<?php echo $kelas['id']; ?>" <?php echo $siswa["nama_kelas"] === $kelas['nama'] ? 'selected' : ''; ?>>
                                <?php echo $kelas['nama']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn accent-color" name="submit">
                    </div>
                </form>

                <?php if (isset($_SESSION['sukses']) && $_SESSION['sukses'] === 1) { ?>
                    <p class="success">Berhasil merubah siswa</p>
                    <?php $_SESSION['sukses'] = 0; ?>
                <?php } ?>
            </article>
        </section>
    </main>

    <script src="assets/js/registrasi_siswa.js"></script>
</body>

</html>