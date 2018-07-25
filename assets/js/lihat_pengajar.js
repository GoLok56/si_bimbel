function confirmDeletion(nip) {
    if (confirm(`Yakin ingin menghapus pengajar dengan nip ${nip}?`)) {
        window.location = `controllers/hapus_pengajar_controller.php?nip=${nip}`    
    }
}