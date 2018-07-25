<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/siswa_repository.php");

if (isset($_GET["nis"])) {
  $nis = $_GET["nis"];

  hapus_siswa($nis);
}

header("location: ../lihat_siswa.php");

?>