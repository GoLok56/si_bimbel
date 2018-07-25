function onPendidikanChanged(value) {
  let jurusanSelect = document.querySelector('#jurusan')

  if (value === 'SMA') {
    jurusanSelect.classList.remove('hide')
  } else {
    if (!jurusanSelect.classList.contains('hide')) {
      jurusanSelect.classList.add('hide')
    }
  }
}

function validateForm() {
  const tbKode = document.querySelector('#kode_pelajaran')
  const tbNama = document.querySelector('#nama_pelajaran')

  let result = true

  if (tbKode.value === '') {
      const errorKode = document.querySelector('#kode_pelajaran + small')
      errorKode.classList.remove('hide')
      tbKode.classList.add('error-color')
      result = false
  }

  if (tbNama.value === '') {
      const errorPassword = document.querySelector('#nama_pelajaran + small')
      errorPassword.classList.remove('hide')
      tbNama.classList.add('error-color')
      result = false
  }

  return result
}