<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/pengajar_repository.php");

if (isset($_POST["submit"])) {
  $nip = $_POST["nip"];
  $pelajaran = $_POST["pengajar_pelajaran"];

  insert_tugas([
    "nip" => $nip,
    "pelajaran" => $pelajaran
  ]);
}

header("location: ../detail_pengajar.php?nip=$nip");

?>