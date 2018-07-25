function confirmDeletion(id, kelas) {
    if (confirm(`Yakin ingin menghapus jadwal dengan id ${id}?`)) {
        window.location = `controllers/hapus_jadwal_controller.php?id=${id}&kelas=${kelas}`    
    }
}