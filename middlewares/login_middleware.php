<?php

function get_menu() {
    if (!isset($_SESSION['has_login'])) {
        header('location: login.php');
    }

    return [
        [
            "judul" => "Beranda",
            "link" => "/bimbel"
        ],
        [
            "judul" => "Siswa",
            "link" => "/bimbel/lihat_siswa.php"
        ],
        [
            "judul" => "Pengajar",
            "link" => "/bimbel/lihat_pengajar.php"
        ],
        [
            "judul" => "Kelas",
            "link" => "/bimbel/lihat_kelas.php"
        ],
        [
            "judul" => "Pelajaran",
            "link" => "/bimbel/lihat_pelajaran.php"
        ],
        [
            "judul" => "Logout",
            "link" => "/bimbel/controllers/logout_controller.php"
        ]
    ];
}