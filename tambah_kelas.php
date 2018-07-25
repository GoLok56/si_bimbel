<?php

require_once('core/init.php'); 
require_once('middlewares/login_middleware.php');

$menus = get_menu();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Kelas - Sistem Informasi Bimbel</title>

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
                <form action="controllers/tambah_kelas_controller.php" method="post" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas" placeholder="Soekarno - I">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn accent-color" name="submit">
                    </div>
                </form>

                <?php if (isset($_SESSION['sukses']) && $_SESSION['sukses'] === 1) { ?>
                    <p class="success">Berhasil menambahkan kelas baru</p>
                    <?php $_SESSION['sukses'] = 0; ?>
                <?php } ?>
            </article>
        </section>
    </main>

    <script src="assets/js/tambah_kelas.js"></script>
</body>

</html>