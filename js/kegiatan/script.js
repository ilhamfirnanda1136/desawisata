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

  try {
    const store = await axios({
      method: 'POST',
      url: `${urlPage}/save`,
      data: formData,
    })
    console.log(store.data)
  } catch (error) {
    console.error(error)
  }
}
// elid('filename').addEventListener('change',() => {
//     files.push(e.target.value)
// })

function init() {
  elid('btn-add-inputfile').onclick = addInputFile
  onEvent('click', removeInputFile)
  form.addEventListener('submit', handleSubmit)
}
document.addEventListener('DOMContentLoaded', init)
