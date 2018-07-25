<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/nilai_repository.php");

if (isset($_GET["id"])) {
  $id = $_GET["id"];

  hapus_nilai($id);
}

header("location: ../nilai_siswa.php?nis=".$_GET['nis']);

?>