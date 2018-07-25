<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/pengajar_repository.php");

if (isset($_POST["submit"])) {
  $nip = $_POST["nip"];
  $nip_lama = $_POST["nip_lama"];
  $nama = $_POST["nama"];
  $jk = $_POST["jenis_kelamin"];
  $ttl = $_POST["tanggal_lahir"];
  $notelp = $_POST["no_telepon"];
  
  update_pengajar([
    "nip" => $nip,
    "nama" => $nama,
    "jk" => $jk,
    "ttl" => $ttl,
    "notelp" => $notelp,
    "nip_lama" => $nip_lama
  ]);
}

header("location: ../ubah_pengajar.php?nip=$nip");

?>