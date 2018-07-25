<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/pelajaran_repository.php");

if (isset($_POST["submit"])) {
  $kode = $_POST["kode_pelajaran"];
  $nama = $_POST["nama_pelajaran"];
  $pendidikan = $_POST["tingkat_pendidikan"];
  $jurusan = $_POST["jurusan"];
  
  if ($pendidikan !== "SMA") {
    $jurusan = null;
  }

  insert_pelajaran([
    "kode" => $kode,
    "nama" => $nama,
    "pendidikan" => $pendidikan,
    "jurusan" => $jurusan
  ]);
}

header("location: ../tambah_pelajaran.php");

?>