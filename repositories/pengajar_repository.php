<?php

function insert_pengajar($pengajar) {
  $link = get_connection();

  $query = "INSERT INTO pengajar VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($link, $query) or die("Error pas buat stmt, errornya: " . mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "sssss", 
    $pengajar["nip"], 
    $pengajar["nama"], 
    $pengajar["jk"], 
    $pengajar["ttl"], 
    $pengajar["notelp"] 
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

function find_all_pengajar() {
  $link = get_connection();

  $query = "SELECT * FROM pengajar ORDER BY nip";
  $result = mysqli_query($link, $query);
  mysqli_close($link);
  return $result;
}

function find_by_nip($nip) {
  $link = get_connection();

  $query = "SELECT * FROM pengajar WHERE nip=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "s", $nip);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $nip_pengajar, $nama, $jk, $ttl, $notelp);

  $result = [];
  if (mysqli_stmt_fetch($stmt)) {
    $result["nip"] = $nip_pengajar;
    $result["nama"] = $nama;
    $result["jk"] = $jk;
    $result["ttl"] = $ttl;
    $result["notelp"] = $notelp;
  }

  mysqli_stmt_close($stmt);
  return $result;
} 

function find_pelajaran_by_nip($nip) {
  $link = get_connection();

  $query = "SELECT pengajar_pelajaran.kode_mapel, nama_pelajaran, tingkat_pendidikan, jurusan FROM pengajar_pelajaran join mata_pelajaran on mata_pelajaran.kode_mapel = pengajar_pelajaran.kode_mapel WHERE nip=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "s", $nip);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $kode, $nama, $pendidikan, $jurusan);

  $result = [];
  while (mysqli_stmt_fetch($stmt)) {
    array_push($result, [
      "kode" => $kode,
      "nama" => $nama,
      "pendidikan" => $pendidikan,
      "jurusan" => $jurusan
    ]);
  }

  mysqli_stmt_close($stmt);
  return $result;
} 

function update_pengajar($pengajar) {
  $link = get_connection();

  $query = "UPDATE pengajar SET nip=?, nama_pengajar=?, jenis_kelamin=?, tanggal_lahir=?, no_telepon=? WHERE nip=?";
  $stmt = mysqli_prepare($link, $query) or die(mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "ssssss", 
    $pengajar['nip'],
    $pengajar['nama'],
    $pengajar['jk'],
    $pengajar['ttl'],
    $pengajar['notelp'],
    $pengajar['nip_lama']
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

function hapus_pengajar($nip) {
  $link = get_connection();

  $query = "DELETE FROM pengajar WHERE nip=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "s", $nip);
  mysqli_stmt_execute($stmt);

  if (!mysqli_stmt_errno($stmt)) {
    mysqli_close($link);
    mysqli_stmt_close($stmt);
  } else {
    echo mysqli_stmt_error($stmt); die();
  }
}

function insert_tugas($pengajar) {
  $link = get_connection();

  $query_select = "SELECT kode_mapel FROM pengajar_pelajaran WHERE nip=?";
  $stmt = mysqli_prepare($link, $query_select) or die(mysqli_error($link));
  mysqli_stmt_bind_param($stmt, "s", $pengajar['nip']) or die(mysqli_stmt_error($stmt));
  mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
  mysqli_stmt_bind_result($stmt, $id);

  $ids = [];
  while (mysqli_stmt_fetch($stmt)) {
    array_push($ids, $id);
  }

  $query = "INSERT INTO pengajar_pelajaran(nip, kode_mapel) VALUES (?, ?)";
  foreach ($pengajar['pelajaran'] as $pelajaran) {
    if (!in_array($pelajaran, $ids)) {
      $stmt = mysqli_prepare($link, $query) or die("Error pas buat stmt, errornya: " . mysqli_error($link));
      mysqli_stmt_bind_param(
        $stmt, 
        "ss", 
        $pengajar["nip"], 
        $pelajaran
      ) or die(mysqli_stmt_error($stmt));
      mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
    }
  }
  
  $query_delete = "DELETE FROM pengajar_pelajaran WHERE kode_mapel=? AND nip=?";
  foreach ($ids as $id) {
    if (!in_array($id, $pengajar['pelajaran'])) {
      $stmt = mysqli_prepare($link, $query_delete) or die(mysqli_error($link));
      mysqli_stmt_bind_param($stmt, "ss", $id, $pengajar['nip']) or die(mysqli_stmt_error($stmt));
      mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
    }
  }

  if (!mysqli_stmt_errno($stmt)) {
    mysqli_close($link);
    mysqli_stmt_close($stmt);
  } else {
    echo mysqli_stmt_error($stmt); die();
  }
}