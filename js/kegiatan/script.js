const urlPage = `${process_env_url}/kegiatan`;
const form = elid('form-kegiatan');

let i = 0;
let arrfiles = []
function addInputFile(){
    i +=1
    arrfiles.push(elid('filename').files)
    // const html = `
    // <div class="col-12 form-group" id="fileinput${i}">
    //     <label for="filename">Upload File Dokumen</label>
    //     <div class="input-group">
    //         <input type="file" name="filename${i}" id="filename${i}" class="form-control">
    //         <div class="input-group-append">
    //             <button class="btn btn-danger rm" data-id_btn="${i}" type="button">
    //             <i class="fa fa-times rm"></i>
    //             </button>
    //         </div>
    //     </div>
    // </div>
    // `
    // elid('add-input-file').innerHTML += html
    // console.log(i)
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
    for(const file of elid('filename').files){
        formData.append('files[]',file)
    }
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
    onEvent('click',removeInputFile);
    form.addEventListener('submit',handleSubmit)

}
document.addEventListener('DOMContentLoaded',init)