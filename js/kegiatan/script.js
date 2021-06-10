const urlPage = `${process_env_url}/kegiatan`
const form = elid('form-kegiatan')

let i = 0
function addInputFile() {
  i += 1
  //   variable element
  const parentDiv = onCreateEl('div')
  const label = onCreateEl('label')
  const input = onCreateEl('INPUT')
  const childDiv = onCreateEl('div')
  const divBtn = onCreateEl('div')
  const btnClose = onCreateEl('button')
  const icon = onCreateEl('i')
  // end
  // set attr element
  parentDiv.setAttribute('class', 'col-12 form-group')
  parentDiv.setAttribute('id', 'fileinput' + i)
  label.setAttribute('for', 'filename')
  label.innerText = 'Upload File Dokumen'
  childDiv.setAttribute('class', 'input-group')
  input.setAttribute('type', 'file')
  input.setAttribute('name', 'filename[]')
  input.setAttribute('id', 'filename')
  input.setAttribute('class', 'form-control')
  divBtn.setAttribute('class', 'input-group-append')
  btnClose.setAttribute('class', 'btn btn-danger rm')
  btnClose.setAttribute('type', 'button')
  btnClose.setAttribute('data-id_btn', i)
  icon.setAttribute('class', 'fa fa-times rm')
  // end
  // render element
  elid('add-input-file').appendChild(parentDiv)
  parentDiv.append(label, childDiv)
  childDiv.append(input, divBtn)
  divBtn.appendChild(btnClose)
  btnClose.appendChild(icon)
  // end
}
function removeInputFile(e) {
  if (e.target.classList.contains('rm')) {
    const id = e.target.dataset.id_btn || e.target.parentElement.dataset.id_btn
    elid(`fileinput${id}`).remove()
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
      { data: 'action', name: 'action' },
    ],
    destroy: true,
  })
}
// elid('filename').addEventListener('change',() => {
//     files.push(e.target.value)
// })

function init() {
  loadTable()
  elid('btn-add-inputfile').onclick = addInputFile
  onEvent('click', [removeInputFile, handleDelete])
  form.addEventListener('submit', handleSubmit)
}
document.addEventListener('DOMContentLoaded', init)
