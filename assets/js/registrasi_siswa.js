function validateForm() {
    const tbNis = document.querySelector('#nis')
    const tbNama = document.querySelector('#nama')
    const tbTtl = document.querySelector('#tanggal_lahir')
    const tbNotelp = document.querySelector('#no_telepon')
    const tbAsalSekolah = document.querySelector('#asal_sekolah')
  
    let result = true
  
    if (tbNis.value === '') {
        const errorNis = document.querySelector('#nis + small')
        errorNis.classList.remove('hide')
        tbNis.classList.add('error-color')
        result = false
    }
  
    if (tbNama.value === '') {
        const errorPassword = document.querySelector('#nama + small')
        errorPassword.classList.remove('hide')
        tbNama.classList.add('error-color')
        result = false
    }

    if (tbTtl.value === '') {
        const errorTtl = document.querySelector('#tanggal_lahir + small')
        errorTtl.classList.remove('hide')
        tbNis.classList.add('error-color')
        result = false
    }
  
    if (tbNotelp.value === '') {
        const errorPassword = document.querySelector('#no_telepon + small')
        errorPassword.classList.remove('hide')
        tbNotelp.classList.add('error-color')
        result = false
    }
  
    if (tbAsalSekolah.value === '') {
        const errorNis = document.querySelector('#asal_sekolah + small')
        errorNis.classList.remove('hide')
        tbAsalSekolah.classList.add('error-color')
        result = false
    }
  
    return result
}