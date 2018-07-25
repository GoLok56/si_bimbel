<?php

function insert_kelas($kelas) {
  $link = get_connection();

  $query = "INSERT INTO kelas(nama_kelas) VALUES (?)";
  $stmt = mysqli_prepare($link, $query) or die("Error pas buat stmt, errornya: " . mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "s", 
    $kelas["nama"] 
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

function find_all_kelas() {
  $link = get_connection();

  $query = "SELECT * FROM kelas ORDER BY nama_kelas";
  $result = mysqli_query($link, $query);
  mysqli_close($link);
  return $result;
}

function find_by_id($id) {
  $link = get_connection();

  $query = "SELECT * FROM kelas WHERE id_kelas=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "d", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id_kelas, $nama);

  $result = [];
  if (mysqli_stmt_fetch($stmt)) {
    $result["id"] = $id_kelas;
    $result["nama"] = $nama;
  }

  mysqli_stmt_close($stmt);
  return $result;
} 

function update_kelas($id, $nama) {
  $link = get_connection();

  $query = "UPDATE kelas SET nama_kelas=? WHERE id_kelas=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "sd", $nama, $id);
  mysqli_stmt_execute($stmt);

  if (!mysqli_stmt_errno($stmt)) {
    $_SESSION['sukses'] = 1;
    mysqli_close($link);
    mysqli_stmt_close($stmt);
  } else {
    echo mysqli_stmt_error($stmt); die();
  }
}

function hapus_kelas($id) {
  $link = get_connection();

  $query = "DELETE FROM kelas WHERE id_kelas=?";
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

function find_jadwal_by_id($id) {
  $link = get_connection();

  $query = "SELECT jadwal_kelas.id, nama_kelas, hari, jam_mulai, jam_berakhir, nama_pelajaran, tingkat_pendidikan, jurusan, nama_pengajar FROM kelas 
            JOIN jadwal_kelas ON kelas.id_kelas = jadwal_kelas.id_kelas 
            JOIN pengajar_pelajaran ON jadwal_kelas.id_pengajar_pelajaran = pengajar_pelajaran.id_pengajar_pelajaran
            JOIN pengajar ON pengajar.nip = pengajar_pelajaran.nip 
            JOIN mata_pelajaran ON pengajar_pelajaran.kode_mapel = mata_pelajaran.kode_mapel 
            WHERE kelas.id_kelas=?";
  $stmt = mysqli_prepare($link, $query);
  echo mysqli_error($link);
  mysqli_stmt_bind_param($stmt, "d", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id_jadwal, $nama_kelas, $hari, $jam_mulai, $jam_berakhir, $nama_pelajaran, $pendidikan, $jurusan, $pengajar);

  $result = [];
  while (mysqli_stmt_fetch($stmt)) {
    array_push($result, [
      "id_jadwal" => $id_jadwal,
      "nama_kelas" => $nama_kelas,
      "hari" => $hari,
      "jam_mulai" => $jam_mulai,
      "jam_berakhir" => $jam_berakhir,
      "nama_pelajaran" => $nama_pelajaran,
      "pendidikan" => $pendidikan,
      "jurusan" => $jurusan,
      "pengajar" => $pengajar
    ]);
  }

  mysqli_stmt_close($stmt);
  return $result;
}

function insert_jadwal_kelas($jadwal) {
  $link = get_connection();

  $query = "INSERT INTO jadwal_kelas VALUES (NULL, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($link, $query) or die("Error pas buat stmt, errornya: " . mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "sssss", 
    $jadwal["id"],
    $jadwal["pelajaran"],
    $jadwal["hari"],
    $jadwal["jam_mulai"],
    $jadwal["jam_berakhir"]
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