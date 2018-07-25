<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/siswa_repository.php");

if (isset($_POST["submit"])) {
  $nis = $_POST["nis"];
  $nis_lama = $_POST["nis_lama"];
  $nama = $_POST["nama"];
  $jk = $_POST["jenis_kelamin"];
  $pendidikan = $_POST["tingkat_pendidikan"];
  $asal = $_POST["asal_sekolah"];
  $ttl = $_POST["tanggal_lahir"];
  $notelp = $_POST["no_telepon"];
  $kelas = $_POST["kelas"];
  
  update_siswa([
    "nis" => $nis,
    "nama" => $nama,
    "jk" => $jk,
    "pendidikan" => $pendidikan,
    "asal_sekolah" => $asal,
    "ttl" => $ttl,
    "notelp" => $notelp,
    "kelas" => $kelas,
    "nis_lama" => $nis_lama
  ]);
}

header("location: ../ubah_siswa.php?nis=$nis");

?>