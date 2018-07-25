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
    <title>Ubah pengajar - Sistem Informasi Bimbel</title>

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
                    <a href="registrasi_pengajar.php">Registrasi Pengajar</a>
                </li>
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
                <form action="controllers/update_pengajar_controller.php" method="post" onsubmit="return validateForm()">
                    <input type="hidden" name="nip_lama" id="nip_lama" value="<?php echo $pengajar['nip'] ?>">
                    
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" 
                            name="nip" 
                            id="nip" 
                            placeholder="9983430001" 
                            maxlength="18" 
                            value="<?php echo $pengajar['nip'] ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" 
                            name="nama" 
                            id="nama" 
                            placeholder="Indra Noah" 
                            value="<?php echo $pengajar['nama'] ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="radio" 
                            name="jenis_kelamin" 
                            id="jenis_kelamin" 
                            value="Laki-laki" 
                            <?php echo $pengajar['jk'] === 'Laki-laki' ? 'checked' : '' ?>> Laki-laki
                        <input type="radio" 
                            name="jenis_kelamin" 
                            id="jenis_kelamin" 
                            value="Perempuan"
                            <?php echo $pengajar['jk'] === 'Perempuan' ? 'checked' : '' ?>> Perempuan
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" 
                            name="tanggal_lahir" 
                            id="tanggal_lahir" 
                            value="<?php echo $pengajar['ttl']?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <input type="text" 
                            name="no_telepon" 
                            id="no_telepon" 
                            placeholder="085681480083"
                            value="<?php echo $pengajar['notelp']?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn accent-color" name="submit">
                    </div>
                </form>

                <?php if (isset($_SESSION['sukses']) && $_SESSION['sukses'] === 1) { ?>
                    <p class="success">Berhasil merubah pengajar</p>
                    <?php $_SESSION['sukses'] = 0; ?>
                <?php } ?>
            </article>
        </section>
    </main>

    <script src="assets/js/registrasi_pengajar.js"></script>
</body>

</html>