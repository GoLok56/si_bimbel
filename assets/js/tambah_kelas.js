function validateForm() {
    const tbNama = document.querySelector('#nama_kelas')
  
    let result = true

    if (tbNama.value === '') {
        const errorNama = document.querySelector('#nama_kelas + small')
        errorNama.classList.remove('hide')
        tbNama.classList.add('error-color')
        result = false
    }
  
    return result
  }