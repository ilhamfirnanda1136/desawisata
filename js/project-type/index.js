//global variable
const urlPage = `${process_env_url}/master-project/project-type`;
const form = elid('form-project');
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
            { data: 'type', name: 'type' },
            { data: 'action', name: 'action' },
        ],
        destroy: true,
    });
}

function showModal() {
    const id = elid('id');
    console.log('ok');
    if (id.value !== '') {
        id.value = '';
    }
    form.reset();
    $('#my-modal').modal({
        show: true,
        backdrop: 'static',
    });
}

async function handleEdit(e) {
    if (e.target.classList.contains('update')) {
        elid('modal-title').innerHTML = 'Ubah Jenis Proyek';
        $('#my-modal').modal({
            show: true,
            backdrop: 'static',
        });
        const id = e.target.dataset.id ?? e.target.parentElement.dataset.id;
        try {
            const getData = await axios(`${urlPage}/show/${+id}`);
            const notAllowed = ['created_at', 'updated_at'];
            for (const key in getData.data) {
                if (!notAllowed.includes(key)) {
                    elid(key).value = getData.data[key];
                }
            }
        } catch (e) {
            console.log(e.error);
        }
    }
}

function handleDelete(e) {
    if (e.target.classList.contains('delete')) {
        const id = e.target.dataset.id ?? e.target.parentElement.dataset.id;
        const urlDelete = `${urlPage}/delete/${+id}`;
        swal({
            title: 'Apakah Kamu Yakin ?',
            text: 'Setelah dihapus anda tidak dapat memulihkan data ini!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                loading();
                axios
                    .delete(urlDelete)
                    .then((res) => {
                        matikanLoading();
                        console.log(res.status);
                        loadTable();
                        onNotif('success', res.message);
                    })
                    .catch((err) => {
                        console.error(err.error);
                        onNotif('err', err.message);
                    });
            }
        });
    }
}

async function handleSubmit(e) {
    e.preventDefault();
    const formData = new FormData(form);
    let icon = '';
    loading();
    try {
        const store = await axios({
            method: 'POST',
            url: `${urlPage}/save`,
            data: formData,
        });
        console.log(store);
        matikanLoading();
        if (store.data.errors === undefined) {
            for (const key in store.data.success) {
                hapusvalidasi(key);
            }
            loadTable();
            $('#my-modal').modal('hide');
            form.reset();
            icon = 'success';
        } else {
            const errors = Object.entries(store.data.errors);
            errors.map(([key, value]) => tambahvalidasi(key, value));
            icon = 'error';
        }
        onNotif(icon, store.data.message);
    } catch (e) {
        console.log(e.message);
        console.error(e.errors);
    }
}

function init() {
    loadTable();
    elid('btn-modal').onclick = showModal;
    onEvent('click', [handleEdit, handleDelete]);
    form.addEventListener('submit', handleSubmit);
}

window.addEventListener('DOMContentLoaded', init);
window.addEventListener('DOMContentLoaded', init);
