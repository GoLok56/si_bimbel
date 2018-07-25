<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/kelas_repository.php");

if (isset($_POST["submit"])) {
  $nama = $_POST["nama_kelas"];

  insert_kelas([
    "nama" => $nama
  ]);
}

header("location: ../tambah_kelas.php");

?>