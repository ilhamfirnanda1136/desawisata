const urlPage = `${process_env_url}/kegiatan`;
const form = elid('form-kegiatan');

let i = 0;
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
    });
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
        console.log(store.data);
        matikanLoading();
        if (store.data.errors === undefined) {
            for (const key in store.data.success) {
                hapusvalidasi(key);
            }
            loadTable();
            form.reset();
            icon = 'success';
        } else {
            const errors = Object.entries(store.data.errors);
            errors.map(([key, value]) => tambahvalidasi(key, value));
            icon = 'error';
        }
        onNotif(icon, store.data.message);
    } catch (error) {
        console.error(error);
    }
}

async function handleEdit(e) {
    if (e.target.classList.contains('edit')) {
        const id = e.target.dataset.id ?? e.target.parentElement.dataset.id;
        try {
            const res = await axios(`${urlPage}/show/${id}`);
            const data = res.data;
            const notAllowed = ['created_at', 'updated_at'];
            for (const key in data) {
                if (!notAllowed.includes(key)) {
                    document.getElementById(key).value = data[key];
                }
            }
        } catch (err) {
            /* handle error */
            console.error(err);
        }
    }
}
function renderDetail(data) {
    const html = `
    <table class="table table-striped" style="width:100%;">
      <tr>
        <td>Tanggal Kegiatan</td>
        <td>:</td>
        <td>${data.tanggal}</td>
      </tr>
      <tr>
        <td>Nama Kegiatan</td>
        <td>:</td>
        <td>${data.nama_kegiatan}</td>
      </tr>
      <tr>
        <td>Waktu Durasi</td>
        <td>:</td>
        <td>${data.waktu_durasi}</td>
      </tr>
      <tr>
        <td>Lokasi</td>
        <td>:</td>
        <td>${data.lokasi}</td>
      </tr>
      <tr>
        <td>Jumlah Peserta</td>
        <td>:</td>
        <td>${data.jumlah_peserta}</td>
      </tr>
      <tr>
        <td>Prosantase Capaian</td>
        <td>:</td>
        <td>${data.prosentase_capaian}</td>
      </tr>
      <tr>
        <td>Keterangan</td>
        <td>:</td>
        <td>${data.keterangan}</td>
      </tr>
    </table>
  `;
    elid('detail-content').innerHTML = html;
}
async function handleDetail(e) {
    if (e.target.classList.contains('detail')) {
        const id = e.target.dataset.id ?? e.target.parentElement.dataset.id;
        $('#modal-detail').modal({
            show: true,
            backdrop: 'static',
        });
        try {
            const res = await axios(`${urlPage}/show/${id}`);
            const data = res.data;
            renderDetail(data);
        } catch (err) {
            /* handle error */
            console.error(err);
        }
    }
}

function handleDelete(e) {
    if (e.target.classList.contains('delete')) {
        const id = e.target.dataset.id ?? e.target.parentElement.dataset.id;
        const urlDelete = `${urlPage}/delete/${+id}`;
        swal({
            title: 'Apakah Kamu Yakin ?',
            text:
                'Data yang anda hapus berkaitan dengan data dokumen kegiatan. \n Setelah dihapus data tidak akan bisa dipulihkan!',
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
                        onNotif('success', res.data.message);
                    })
                    .catch((err) => {
                        console.error(err.error);
                        onNotif('err', err.message);
                    });
            }
        });
    }
}

// elid('filename').addEventListener('change',() => {
//     files.push(e.target.value)
// })

function init() {
    loadTable();
    onEvent('click', [handleDelete, handleEdit, handleDetail]);
    form.addEventListener('submit', handleSubmit);
}
document.addEventListener('DOMContentLoaded', init);
