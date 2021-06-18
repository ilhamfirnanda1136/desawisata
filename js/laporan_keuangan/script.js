const urlPage = `${process_env_url}/kegiatan/laporan-keuangan`
const form = elid('form-laporan-keuangan')
function loadTable() {
  $('#table').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    lengtChange: true,
    autoWidth: false,
    ajax: {
      url: `${urlPage}/json-dt/${+kegiatanId}`,
    },
    columns: [
      { data: 'DT_RowIndex', name: 'id' },
      { data: 'tgl', name: 'tgl' },
      { data: 'pengeluaran', name: 'pengeluaran' },
      {
        data: 'bukti_pengeluaran',
        render: (row) =>
          ` <a href="${url}/public/storage/${row}" class="shadow-sm mx-2 p-2" data-toggle="lightbox" data-gallery="gallery">
          <img src="${url}/public/storage/${row}" class="img-fluid" width="100" height="100" alt="" >
          </a>`,
        name: 'bukti_pengeluaran',
      },
      { data: 'action', name: 'action' },
    ],
    destroy: true,
  })
}

async function handleSubmit(e) {
  e.preventDefault()
  const formData = new FormData(form)
  formData.append('pengeluaran', removePoint(elid('pengeluaran').value))
  let icon = ''
  loading()
  try {
    const store = await axios({
      method: 'POST',
      url: `${urlPage}/save`,
      data: formData,
    })
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

function init() {
  loadTable()
  elid('pengeluaran').onkeyup = (e) =>
    (e.target.value = inputIDR(e.target.value))
  onEvent('click', handleDelete)
  form.addEventListener('submit', handleSubmit)
  $(document).on('click', '[data-toggle="lightbox"]', function (event) {
    event.preventDefault()
    $(this).ekkoLightbox({
      alwaysShowClose: true,
    })
  })
}
document.addEventListener('DOMContentLoaded', init)
