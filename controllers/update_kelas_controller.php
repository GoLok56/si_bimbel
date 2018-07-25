<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/kelas_repository.php");

if (isset($_POST["submit"])) {
  $id = $_POST["id"];
  $nama = $_POST["nama_kelas"];
  
  update_kelas($id, $nama);
}

header("location: ../ubah_kelas.php?id=$id");

?>