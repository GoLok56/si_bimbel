<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/pelajaran_repository.php");

if (isset($_GET["kode"])) {
  $kode = $_GET["kode"];

  hapus_pelajaran($kode);
}

header("location: ../lihat_pelajaran.php");

?>