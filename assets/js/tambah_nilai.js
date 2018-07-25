function validateForm() {
    const tbNilai = document.querySelector('#nilai')
    const tbKeterangan = document.querySelector('#keterangan')

    let result = true
  
    if (tbNilai.value === '') {
        const errorNilai = document.querySelector('#nilai + small')
        errorNilai.classList.remove('hide')
        tbNilai.classList.add('error-color')
        result = false
    }
  
    if (tbKeterangan.value === '') {
        const errorKeterangan = document.querySelector('#keterangan + small')
        errorKeterangan.classList.remove('hide')
        tbKeterangan.classList.add('error-color')
        result = false
    }
  
    return result
}