<?php

function insert_nilai($nilai) {
  $link = get_connection();

  $query = "INSERT INTO nilai_siswa VALUES (null, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($link, $query) or die("Error pas buat stmt, errornya: " . mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "ssss", 
    $nilai["nis"], 
    $nilai["pelajaran"], 
    $nilai["nilai"], 
    $nilai["keterangan"]
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

function find_nilai_by_id($id) {
  $link = get_connection();

  $query = "SELECT id, nilai, keterangan, nama_pelajaran FROM nilai_siswa 
            JOIN pengajar_pelajaran ON pengajar_pelajaran.id_pengajar_pelajaran = nilai_siswa.id_pengajar_pelajaran 
            JOIN mata_pelajaran ON mata_pelajaran.kode_mapel = pengajar_pelajaran.kode_mapel 
            WHERE id=?";
  $stmt = mysqli_prepare($link, $query);
  echo mysqli_error($link);
  mysqli_stmt_bind_param($stmt, "d", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result(
    $stmt, 
    $id,
    $nilai,
    $keterangan,
    $nama_pelajaran
  );

  $result = [];
  if (mysqli_stmt_fetch($stmt)) {
    $result["id"] = $id;
    $result["nilai"] = $nilai;
    $result["keterangan"] = $keterangan;
    $result['nama_pelajaran'] = $nama_pelajaran;
  }

  mysqli_stmt_close($stmt);
  return $result;
}

function update_nilai($nilai) {
  $link = get_connection();

  $query = "UPDATE nilai_siswa SET nilai=?, keterangan=? WHERE id=?";
  $stmt = mysqli_prepare($link, $query);
  echo mysqli_error($link);
  mysqli_stmt_bind_param($stmt, "dsd", $nilai['nilai'], $nilai['keterangan'], $nilai['id']);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);
  return $result;
}

function hapus_nilai($id) {
  $link = get_connection();

  $query = "DELETE FROM nilai_siswa WHERE id=?";
  $stmt = mysqli_prepare($link, $query);
  echo mysqli_error($link);
  mysqli_stmt_bind_param($stmt, "d", $id);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);
  return $result;
}