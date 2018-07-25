<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/pelajaran_repository.php");

if (isset($_POST["submit"])) {
  $kode = $_POST["kode_pelajaran"];
  $kode_lama = $_POST["kode_lama"];
  $nama = $_POST["nama_pelajaran"];
  $pendidikan = $_POST["tingkat_pendidikan"];
  $jurusan = $_POST["jurusan"];
  
  if ($pendidikan !== "SMA") {
    $jurusan = null;
  }

  update_pelajaran([
    "kode" => $kode,
    "nama" => $nama,
    "pendidikan" => $pendidikan,
    "jurusan" => $jurusan,
    "kode_lama" => $kode_lama
  ]);
}

header("location: ../ubah_pelajaran.php?kode=$kode");

?>