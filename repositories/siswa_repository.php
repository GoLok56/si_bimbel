<?php

function insert_siswa($siswa) {
  $link = get_connection();

  $query = "INSERT INTO siswa VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($link, $query) or die("Error pas buat stmt, errornya: " . mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "ssssssss", 
    $siswa["nis"], 
    $siswa["nama"], 
    $siswa["asal_sekolah"], 
    $siswa["ttl"], 
    $siswa["pendidikan"],
    $siswa["jk"],
    $siswa["notelp"],
    $siswa["kelas"]
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

function find_all_siswa() {
  $link = get_connection();

  $query = "SELECT nis, nama_siswa, asal_sekolah, jenis_kelamin, nama_kelas FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas ORDER BY nama_kelas, nis";
  $result = mysqli_query($link, $query);
  mysqli_close($link);
  return $result;
}

function find_by_nis($nis) {
  $link = get_connection();

  $query = "SELECT * FROM siswa JOIN kelas ON kelas.id_kelas = siswa.id_kelas WHERE nis=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "s", $nis);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result(
    $stmt, 
    $nis, 
    $nama, 
    $asal,
    $ttl,
    $pendidikan,
    $jk, 
    $notelp,
    $id_kelasS,
    $id_kelasK,
    $nama_kelas
  );

  $result = [];
  if (mysqli_stmt_fetch($stmt)) {
    $result["nis"] = $nis;
    $result["nama"] = $nama;
    $result["asal_sekolah"] = $asal;
    $result["ttl"] = $ttl;
    $result["pendidikan"] = $pendidikan;
    $result["jk"] = $jk;
    $result["notelp"] = $notelp;
    $result["id_kelas"] = $id_kelasS;
    $result["nama_kelas"] = $nama_kelas;
    
  }

  mysqli_stmt_close($stmt);
  return $result;
} 

function update_siswa($siswa) {
  $link = get_connection();

  $query = "UPDATE siswa SET nis=?, nama_siswa=?, asal_sekolah=?, tingkat_pendidikan= ?, jenis_kelamin=?, tanggal_lahir=?, no_telepon=?, id_kelas=? WHERE nis=?";
  $stmt = mysqli_prepare($link, $query) or die(mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "sssssssss", 
    $siswa['nis'],
    $siswa['nama'],
    $siswa['asal_sekolah'],
    $siswa['pendidikan'],
    $siswa['jk'],
    $siswa['ttl'],
    $siswa['notelp'],
    $siswa['kelas'],
    $siswa['nis_lama']
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

function hapus_siswa($nis) {
  $link = get_connection();

  $query = "DELETE FROM siswa WHERE nis=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "s", $nis);
  mysqli_stmt_execute($stmt);

  if (!mysqli_stmt_errno($stmt)) {
    mysqli_close($link);
    mysqli_stmt_close($stmt);
  } else {
    echo mysqli_stmt_error($stmt); die();
  }
}

function find_pelajaran_by_nis($nis) {
  $link = get_connection();

  $query = "SELECT nama_pelajaran, mata_pelajaran.tingkat_pendidikan, jurusan, nama_pengajar, pengajar_pelajaran.id_pengajar_pelajaran FROM siswa
            JOIN jadwal_kelas ON siswa.id_kelas = jadwal_kelas.id_kelas
            JOIN pengajar_pelajaran ON pengajar_pelajaran.id_pengajar_pelajaran = jadwal_kelas.id_pengajar_pelajaran 
            JOIN pengajar ON pengajar_pelajaran.nip = pengajar.nip
            JOIN mata_pelajaran ON mata_pelajaran.kode_mapel = pengajar_pelajaran.kode_mapel WHERE siswa. nis=?";
  $stmt = mysqli_prepare($link, $query);
  echo mysqli_error($link);
  mysqli_stmt_bind_param($stmt, "s", $nis);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result(
    $stmt, 
    $nama_pelajaran,
    $pendidikan,
    $jurusan,
    $nama_pengajar,
    $id_pengajar_pelajaran
  );

  $result = [];
  while (mysqli_stmt_fetch($stmt)) {
    array_push($result , [
      "nama_pelajaran" => $nama_pelajaran,
      "pendidikan" => $pendidikan,
      "jurusan" => $jurusan,
      "nama_pengajar" => $nama_pengajar,
      "id_pengajar_pelajaran" => $id_pengajar_pelajaran
    ]);
  }

  mysqli_stmt_close($stmt);
  return $result;
}

function find_nilai_by_nis_and_id($id, $nis) {
  $link = get_connection();

  $query = "SELECT id, nilai, keterangan FROM nilai_siswa WHERE nis=? and id_pengajar_pelajaran=?";
  $stmt = mysqli_prepare($link, $query);
  echo mysqli_error($link);
  mysqli_stmt_bind_param($stmt, "sd", $nis, $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result(
    $stmt, 
    $id,
    $nilai,
    $keterangan
  );

  $result = [];
  while (mysqli_stmt_fetch($stmt)) {
    array_push($result , [
      "id" => $id,
      "nilai" => $nilai,
      "keterangan" => $keterangan
    ]);
  }

  mysqli_stmt_close($stmt);
  return $result;
}