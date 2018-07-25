function confirmDeletion(kode) {
    if (confirm(`Yakin ingin menghapus pelajaran dengan kode ${kode}?`)) {
        window.location = `controllers/hapus_pelajaran_controller.php?kode=${kode}`    
    }
}