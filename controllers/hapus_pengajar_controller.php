<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/pengajar_repository.php");

if (isset($_GET["nip"])) {
  $nip = $_GET["nip"];

  hapus_pengajar($nip);
}

header("location: ../lihat_pengajar.php");

?>