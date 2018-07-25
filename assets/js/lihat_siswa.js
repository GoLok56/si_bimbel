function confirmDeletion(nis) {
    if (confirm(`Yakin ingin menghapus siswa dengan nis ${nis}?`)) {
        window.location = `controllers/hapus_siswa_controller.php?nis=${nis}`    
    }
}