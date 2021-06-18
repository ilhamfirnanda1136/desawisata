const urlPage = `${process_env_url}/kegiatan`
const form = elid('form-kegiatan')

let i = 0
function loadTable() {
  $('#table').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    lengtChange: true,
    autoWidth: false,
    ajax: {
      url: `${urlPage}/${projectId}/${dateKegiatan}/json-dt`,
    },
    columns: [
      { data: 'DT_RowIndex', name: 'id' },
      { data: 'nama_kegiatan', name: 'nama_kegiatan' },
      { data: 'keterangan', name: 'keterangan' },
      { data: 'prosentase_capaian', name: 'prosentase_capaian' },
      { data: 'action', name: 'action' },
    ],
    destroy: true,
  })
}

async function handleSubmit(e) {
  e.preventDefault()
  const formData = new FormData(form)
  let icon = ''
  loading()
  try {
    const store = await axios({
      method: 'POST',
      url: `${urlPage}/save`,
      data: formData,
    })
    console.log(store.data)
    matikanLoading()
    if (store.data.errors === undefined) {
      for (const key in store.data.success) {
        hapusvalidasi(key)
      }
      loadTable()
      form.reset()
      icon = 'success'
    } else {
      const errors = Object.entries(store.data.errors)
      errors.map(([key, value]) => tambahvalidasi(key, value))
      icon = 'error'
    }
    onNotif(icon, store.data.message)
  } catch (error) {
    console.error(error)
  }
}

function handleDelete(e) {
  if (e.target.classList.contains('delete')) {
    const id = e.target.dataset.id ?? e.target.parentElement.dataset.id
    console.log(id)
    const urlDelete = `${urlPage}/delete/${+id}`
    swal({
      title: 'Apakah Kamu Yakin ?',
      text:
        'Data yang anda hapus berkaitan dengan data dokumen kegiatan. \n Setelah dihapus data tidak akan bisa dipulihkan!',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        loading()
        axios
          .delete(urlDelete)
          .then((res) => {
            matikanLoading()
            console.log(res.status)
            loadTable()
            onNotif('success', res.data.message)
          })
          .catch((err) => {
            console.error(err.error)
            onNotif('err', err.message)
          })
      }
    })
  }
}

// elid('filename').addEventListener('change',() => {
//     files.push(e.target.value)
// })

function init() {
  loadTable()
  onEvent('click', [handleDelete])
  form.addEventListener('submit', handleSubmit)
}
document.addEventListener('DOMContentLoaded', init)
