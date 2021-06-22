//global variable
const urlPage = `${process_env_url}/aparat/desa`
const form = elid('form-aparat')
//

function loadTable() {
  $('#table').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    lengtChange: true,
    autoWidth: false,
    ajax: {
      url: `${urlPage}/json-dt`,
    },
    columns: [
      { data: 'DT_RowIndex', name: 'id' },
      {
        data: 'foto',
        render: (data) => {
          let img = ''
          if (data !== null) {
            img = `<img src="${process_env_url}/public/storage/${data}" style="width:50px;height:50px;">`
          } else {
            img = 'Belum mengupload logo'
          }
          return img
        },
        name: 'foto',
      },
      { data: 'nama', name: 'nama' },
      { data: 'jenis_kelamin', name: 'jenis_kelamin' },
      { data: 'masteraparat.jabatan', name: 'masteraparat.jabatan' },
      { data: 'action', name: 'action' },
    ],
    destroy: true,
  })
}

function showModal() {
  const id = elid('id')
  console.log('ok')
  if (id.value !== '') {
    id.value = ''
  }
  form.reset()
  $('#my-modal').modal({
    show: true,
    backdrop: 'static',
  })
}

async function handleEdit(e) {
  if (e.target.classList.contains('update')) {
    elid('modal-title').innerHTML = 'Ubah Jenis Proyek'
    $('#my-modal').modal({
      show: true,
      backdrop: 'static',
    })
    const id = e.target.dataset.id ?? e.target.parentElement.dataset.id
    try {
      const getData = await axios(`${urlPage}/show/${+id}`)
      console.log(getData)
      const notAllowed = [
        'wisata',
        'masteraparat',
        'foto',
        'user_id',
        'created_at',
        'updated_at',
        'pusat_id',
      ]
      for (const key in getData.data) {
        if (!notAllowed.includes(key)) {
          elid(key).value = getData.data[key]
        }
      }
    } catch (e) {
      console.error(e)
    }
  }
}
function renderDetail(data) {
  const html = `
        <div class="text-center mb-2">
            <img src="${process_env_url}/public/storage/${data.foto}" style="width:50px; height:50px;">
        </div>
        <table class="table table-striped" style="width:100%">
            <tr>
                <th>Nama</th>
                <td>:</td>
                <td>${data.nama}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>:</td>
                <td>${data.jenis_kelamin}</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>:</td>
                <td>${data.masteraparat.jabatan}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>:</td>
                <td>${data.alamat}</td>
            </tr>
            <tr>
                <th colspan="3" class="text-center">Wisata</th>
            </tr>
        </table>
        <div class="input-group" id="map-view" style="width:100%; height:400px"
                    style="text-align:center;"></div>
    `
  elid('modalBody').innerHTML = html
}

function renderGmap(lat, lang) {
  var myLatLng = { lat: parseFloat(lat), lng: parseFloat(lang) }
  var map = new google.maps.Map(document.querySelector('#map-view'), {
    zoom: 9,
    center: myLatLng,
  })
  new google.maps.Marker({
    position: myLatLng,
    map: map,
    label: 'P',
  })
}

async function handleDetail(e) {
  if (e.target.classList.contains('detail')) {
    $('#modalDetail').modal({
      show: true,
      backdrop: 'static',
    })
    const id = e.target.dataset.id ?? e.target.parentElement.dataset.id
    try {
      const res = await axios(`${urlPage}/show/${+id}`)
      const data = res.data
      let lat = data.wisata.latitude
      let lang = data.wisata.langtitude
      renderDetail(data)
      renderGmap(lat, lang)
    } catch (error) {
      console.error(error)
    }
  }
}

function handleDelete(e) {
  if (e.target.classList.contains('delete')) {
    const id = e.target.dataset.id ?? e.target.parentElement.dataset.id
    const urlDelete = `${urlPage}/delete/${+id}`
    swal({
      title: 'Apakah Kamu Yakin ?',
      text: 'Setelah dihapus anda tidak dapat memulihkan data ini!',
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
            onNotif('success', res.message)
          })
          .catch((err) => {
            console.error(err.error)
            onNotif('err', err.message)
          })
      }
    })
  }
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
    console.log(store)
    matikanLoading()
    if (store.data.errors === undefined) {
      for (const key in store.data.success) {
        hapusvalidasi(key)
      }
      loadTable()
      $('#my-modal').modal('hide')
      form.reset()
      icon = 'success'
    } else {
      const errors = Object.entries(store.data.errors)
      errors.map(([key, value]) => tambahvalidasi(key, value))
      icon = 'error'
    }
    onNotif(icon, store.data.message)
  } catch (e) {
    console.error(e)
  }
}

function init() {
  loadTable()
  elid('btn-modal').onclick = showModal
  onEvent('click', [handleEdit, handleDelete, handleDetail])
  $('#tahun_project').datepicker({
    format: 'yyyy',
    viewMode: 'years',
    minViewMode: 'years',
  })
  form.addEventListener('submit', handleSubmit)
}

window.addEventListener('DOMContentLoaded', init)
