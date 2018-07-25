<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/nilai_repository.php");

if (isset($_POST["submit"])) {
  $nis = $_POST["nis"];
  $pelajaran = $_POST['pelajaran'];
  $nilai = $_POST["nilai"];
  $keterangan = $_POST['keterangan'];

  insert_nilai([
    "nis" => $nis,
    "pelajaran" => $pelajaran,
    "nilai" => $nilai,
    "keterangan" => $keterangan
  ]);
}

header("location: ../nilai_siswa.php?nis=".$_POST['nis']);

?>