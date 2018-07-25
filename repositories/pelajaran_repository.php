<?php

function insert_pelajaran($pelajaran) {
  $link = get_connection();

  $query = "INSERT INTO mata_pelajaran VALUES (?, ?, ?, ?)";
  $stmt = mysqli_prepare($link, $query) or die("Error pas buat stmt, errornya: " . mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "ssss", 
    $pelajaran["kode"], 
    $pelajaran["nama"], 
    $pelajaran["pendidikan"], 
    $pelajaran["jurusan"]
  ) or die(mysqli_stmt_error($stmt));
  mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
  
  if (!mysqli_stmt_errno($stmt)) {
    $_SESSION['sukses'] = 1;
    mysqli_close($link);
    mysqli_stmt_close($stmt);
  } else {
    echo mysqli_stmt_error($stmt); die();
  }
}

function find_all_pelajaran() {
  $link = get_connection();

  $query = "SELECT * FROM mata_pelajaran ORDER BY kode_mapel, tingkat_pendidikan, jurusan";
  $result = mysqli_query($link, $query);
  
  mysqli_close($link);
  return $result;
}

function find_by_kode($kode) {
  $link = get_connection();

  $query = "SELECT * FROM mata_pelajaran WHERE kode_mapel=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "s", $kode);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $kode_mapel, $nama, $pendidikan, $jurusan);

  $result = [];
  if (mysqli_stmt_fetch($stmt)) {
    $result["kode"] = $kode_mapel;
    $result["nama"] = $nama;
    $result["pendidikan"] = $pendidikan;
    $result["jurusan"] = $jurusan;
  }

  mysqli_stmt_close($stmt);
  return $result;
}

function update_pelajaran($pelajaran) {
  $link = get_connection();

  $query = "UPDATE mata_pelajaran SET kode_mapel=?, nama_pelajaran=?, tingkat_pendidikan=?, jurusan=? WHERE kode_mapel=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param(
    $stmt, 
    "sssss",
    $pelajaran["kode"], 
    $pelajaran["nama"], 
    $pelajaran["pendidikan"], 
    $pelajaran["jurusan"],
    $pelajaran["kode_lama"]
  );
  mysqli_stmt_execute($stmt);

  if (!mysqli_stmt_errno($stmt)) {
    $_SESSION['sukses'] = 1;
    mysqli_close($link);
    mysqli_stmt_close($stmt);
  } else {
    echo mysqli_stmt_error($stmt); die();
  }
}

function hapus_pelajaran($kode) {
  $link = get_connection();

  $query = "DELETE FROM mata_pelajaran WHERE kode_mapel=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "s", $kode);
  mysqli_stmt_execute($stmt);

  if (!mysqli_stmt_errno($stmt)) {
    mysqli_close($link);
    mysqli_stmt_close($stmt);
  } else {
    echo mysqli_stmt_error($stmt); die();
  }
}