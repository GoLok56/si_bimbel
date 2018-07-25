function validateForm() {
    const tbNip = document.querySelector('#nip')
    const tbNama = document.querySelector('#nama')
    const tbTtl = document.querySelector('#tanggal_lahir')
    const tbNotelp = document.querySelector('#no_telepon')
  
    let result = true
  
    if (tbNip.value === '') {
        const errorNip = document.querySelector('#nip + small')
        errorNip.classList.remove('hide')
        tbNip.classList.add('error-color')
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
        tbNip.classList.add('error-color')
        result = false
    }
  
    if (tbNotelp.value === '') {
        const errorPassword = document.querySelector('#no_telepon + small')
        errorPassword.classList.remove('hide')
        tbNotelp.classList.add('error-color')
        result = false
    }
  
    return result
  }