function confirmDeletion(id, nis) {
    if (confirm(`Yakin ingin menghapus nilai dengan id ${id}?`)) {
        window.location = `controllers/hapus_nilai_controller.php?id=${id}&nis=${nis}`    
    }
}