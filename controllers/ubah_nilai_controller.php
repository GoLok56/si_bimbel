<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/nilai_repository.php");

if (isset($_POST["submit"])) {
  $id = $_POST["id"];
  $nilai = $_POST["nilai"];
  $keterangan = $_POST['keterangan'];

  update_nilai([
    "id" => $id,
    "nilai" => $nilai,
    "keterangan" => $keterangan
  ]);
}

header("location: ../nilai_siswa.php?nis=".$_POST['nis']);

?>