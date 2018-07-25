<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/siswa_repository.php");

if (isset($_POST["submit"])) {
  $nis = $_POST["nis"];
  $nama = $_POST["nama"];
  $jk = $_POST["jenis_kelamin"];
  $pendidikan = $_POST["tingkat_pendidikan"];
  $asal_sekolah = $_POST["asal_sekolah"];
  $ttl = $_POST["tanggal_lahir"];
  $notelp = $_POST["no_telepon"];
  $kelas = $_POST["kelas"];
  
  insert_siswa([
    "nis" => $nis,
    "nama" => $nama,
    "jk" => $jk,
    "pendidikan" => $pendidikan,
    "asal_sekolah" => $asal_sekolah,
    "ttl" => $ttl,
    "notelp" => $notelp,
    "kelas" => $kelas
  ]);
}

header("location: ../registrasi_siswa.php");

?>