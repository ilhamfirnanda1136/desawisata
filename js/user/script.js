//global variable
const urlPage = `${process_env_url}/user`;
const form = elid('form-user');
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
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            { data: 'level', render:(data) => checkLevel(data), name: 'level' },
            { data: 'pusat.kd_name', name: 'pusat.kd_name'},
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
        elid('modal-title').innerHTML = 'Ubah Data User';
        $('#my-modal').modal({
            show: true,
            backdrop: 'static',
        });
        const id = e.target.dataset.id ?? e.target.parentElement.dataset.id;
        try {
            const getData = await axios(`${urlPage}/show/${+id}`);
            const notAllowed = ['created_at', 'updated_at','email_verified_at','pusat'];
            for (const key in getData.data) {
                if (!notAllowed.includes(key)) {
                    elid(key).value = getData.data[key];
                }
            }
        } catch (e) {
            console.log(e);
        }
    }
}
function renderDetail(data){
    const html = `
        <table class="table table-striped" style="width:100%">
            <tr>
                <th>Nama</th>
                <td>:</td>
                <td>${data.name}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>:</td>
                <td>${data.username}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>:</td>
                <td>${data.email}</td>
            </tr>
            <tr>
                <th>pusat</th>
                <td>:</td>
                <td>${data.pusat.kd_name}</td>
            </tr>
            <tr>
                <th>Level</th>
                <td>:</td>
                <td>${checkLevel(data.level)}</td>
            </tr>
            
        </table>
    `
    elid('modalBody').innerHTML = html
}
function checkLevel(level){
    let result = ''
    switch (level) {
        case 1:
            result = 'DPP'
            break;
        case 2:
            result = 'DPD'
            break;
        case 3:
            result = 'Pendamping'
            break;
            
        default:
            result = 'Tidak ada level'
            break;
    }
    return result;
}

async function handleDetail(e){
    if (e.target.classList.contains('detail')) {
        $('#modalDetail').modal({
            show: true,
            backdrop: 'static',
        });
        const id = e.target.dataset.id ?? e.target.parentElement.dataset.id;
        try {
            const res = await axios(`${urlPage}/show/${+id}`)
            const data = res.data
            renderDetail(data)
        } catch (error) {
            console.error(error)
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
                        console.error(err);
                        onNotif('err', 'Internal Server Error');
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
        console.error(e);
    }
}

function init() {
    loadTable();
    elid('btn-modal').onclick = showModal;
    onEvent('click', [handleEdit, handleDelete,handleDetail]);
    form.addEventListener('submit', handleSubmit);
}

window.addEventListener('DOMContentLoaded', init);
