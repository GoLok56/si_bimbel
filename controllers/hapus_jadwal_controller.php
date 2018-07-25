<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/jadwal_kelas_repository.php");

if (isset($_GET["id"])) {
  $id = $_GET["id"];

  hapus_jadwal($id);
}

header("location: ../lihat_jadwal.php?id=".$_GET['kelas']);

?>