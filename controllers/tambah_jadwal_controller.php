<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/kelas_repository.php");

if (isset($_POST["submit"])) {
  $id = $_POST["id"];
  $pelajaran = $_POST['pelajaran'];
  $hari = $_POST['hari'];
  $jam_mulai = $_POST['jam_mulai'];
  $jam_berakhir = $_POST['jam_berakhir'];

  insert_jadwal_kelas([
    "id" => $id,
    "pelajaran" => $pelajaran,
    "hari" => $hari,
    "jam_mulai" => $jam_mulai,
    "jam_berakhir" => $jam_berakhir
  ]);
}

header("location: ../lihat_jadwal.php?id=".$_POST['id']);

?>