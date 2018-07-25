<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/pengajar_repository.php");

if (isset($_POST["submit"])) {
  $nip = $_POST["nip"];
  $nama = $_POST["nama"];
  $jk = $_POST["jenis_kelamin"];
  $ttl = $_POST["tanggal_lahir"];
  $notelp = $_POST["no_telepon"];
  
  insert_pengajar([
    "nip" => $nip,
    "nama" => $nama,
    "jk" => $jk,
    "ttl" => $ttl,
    "notelp" => $notelp
  ]);
}

header("location: ../registrasi_pengajar.php");

?>