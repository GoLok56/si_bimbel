function confirmDeletion(id) {
    if (confirm(`Yakin ingin menghapus kelas dengan id ${id}?`)) {
        window.location = `controllers/hapus_kelas_controller.php?id=${id}`    
    }
}