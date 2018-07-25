<?php

function find_jadwal_by_id_jadwal($id) {
    $link = get_connection();

  $query = "SELECT jadwal_kelas.id, nama_kelas, hari, jam_mulai, jam_berakhir, nama_pelajaran, tingkat_pendidikan, jurusan, nama_pengajar FROM kelas 
            JOIN jadwal_kelas ON kelas.id_kelas = jadwal_kelas.id_kelas 
            JOIN pengajar_pelajaran ON jadwal_kelas.id_pengajar_pelajaran = pengajar_pelajaran.id_pengajar_pelajaran
            JOIN pengajar ON pengajar.nip = pengajar_pelajaran.nip 
            JOIN mata_pelajaran ON pengajar_pelajaran.kode_mapel = mata_pelajaran.kode_mapel 
            WHERE jadwal_kelas.id=?";
  $stmt = mysqli_prepare($link, $query);
  echo mysqli_error($link);
  mysqli_stmt_bind_param($stmt, "d", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id_jadwal, $nama_kelas, $hari, $jam_mulai, $jam_berakhir, $nama_pelajaran, $pendidikan, $jurusan, $pengajar);

  $result = [];
  if (mysqli_stmt_fetch($stmt)) {
      $result["id_jadwal"] = $id_jadwal;
      $result["nama_kelas"] = $nama_kelas;
      $result["hari"] = $hari;
      $result["jam_mulai"] = $jam_mulai;
      $result["jam_berakhir"] = $jam_berakhir;
      $result["nama_pelajaran"] = $nama_pelajaran;
      $result["pendidikan"] = $pendidikan;
      $result["jurusan"] = $jurusan;
      $result["pengajar"] = $pengajar;
  }

  mysqli_stmt_close($stmt);
  return $result;
}

function hapus_jadwal($id) {
    $link = get_connection();

    $query = "DELETE FROM jadwal_kelas WHERE id=?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "d", $id);
    mysqli_stmt_execute($stmt);
  
    if (!mysqli_stmt_errno($stmt)) {
      mysqli_close($link);
      mysqli_stmt_close($stmt);
    } else {
      echo mysqli_stmt_error($stmt); die();
    }
}

function update_jadwal($jadwal) {
  $link = get_connection();

  $query = "UPDATE jadwal_kelas SET hari=?, jam_mulai=?, jam_berakhir=? WHERE id=?";
  $stmt = mysqli_prepare($link, $query);
  echo mysqli_error($link);
  mysqli_stmt_bind_param($stmt, "sssd", $jadwal['hari'], $jadwal['jam_mulai'], $jadwal['jam_berakhir'], $jadwal['id']);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);
  return $result;
}