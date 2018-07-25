<?php

function find_all_pengajar_pelajaran() {
  $link = get_connection();

  $query = "SELECT * FROM pengajar_pelajaran JOIN pengajar ON pengajar.nip = pengajar_pelajaran.nip JOIN mata_pelajaran ON mata_pelajaran.kode_mapel = pengajar_pelajaran.kode_mapel";
  $result = mysqli_query($link, $query);
  mysqli_close($link);
  return $result;
}