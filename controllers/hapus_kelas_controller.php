<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/kelas_repository.php");

if (isset($_GET["id"])) {
  $id = $_GET["id"];

  hapus_kelas($id);
}

header("location: ../lihat_kelas.php");

?>