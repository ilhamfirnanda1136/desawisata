let current_page = 1;
function getData(page, filter) {
    return new Promise((resolve) => {
        resolve(
            fetch(`${base_url}/api/desa/pendamping?page=${page}&dpd=${filter}`),
        );
    });
}

async function run(page = 1, filter = '') {
    const res = await getData(page, filter);
    const data = await res.json();
    localStorage.setItem('last_page', data.pendamping.last_page);
    renderCard(data.pendamping.data);
}

function renderCard(data) {
    const row = document.querySelector('.row');
    let render = '';
    data.forEach((item) => {
        const foto =
            item.foto.length > 0
                ? `https://dpd.asppi.or.id/foto/${item.foto}`
                : base_url + '/images/person1.png';
        const html = `
        <div class="col-sm-12 col-md-4">
        <div class="card shadow">
            <div class="d-flex justify-content-center p-4">
                <img src="${foto}" class="img-rounded" width="100" height="100"  alt="">
            </div>
            <div class="card-bod text-center p-3">
                <h5 class="card-title">${item.nama_pendamping.toUpperCase()}</h5>
                <h6 class="card-subtitle mb-2 text-muted">DPD : ${
                    item.user.pusat.kd_name
                }</h6>
                <button class="btn btn-primary detail-pendamping" data-id="${
                    item.id
                }">Detail</button>
            </div>
        </div>
    </div>
        `;
        render += html;
    });
    row.innerHTML = render;
}

async function firstPage() {
    run(1);
}
async function lastPage() {
    //   console.log(i + 1)
    run(localStorage.getItem('last_page'));
}

const ul = document.querySelector('.pagination');
async function pageNumber() {
    const totalLi = document.querySelectorAll('.page-item').length;
    const li = ul.querySelector(`li:nth-child(${totalLi})`);
    const lastPage = localStorage.getItem('last_page');
    for (let i = 1; i < +lastPage + 1; i++) {
        const numberPage = document.createElement('li');
        numberPage.setAttribute('class', 'page-item');
        const a = document.createElement('a');
        a.setAttribute('href', 'javascript:void(0)');
        a.setAttribute('class', 'page-link page-number');
        a.setAttribute('data-number', i);
        // a.setAttribute('data-page', data.pendamping.current_page)
        const aText = document.createTextNode(i);
        a.appendChild(aText);
        numberPage.appendChild(a);

        ul.insertBefore(numberPage, li);
    }
}
async function detailPendamping(e) {
    if (e.target.classList.contains('detail-pendamping')) {
        const myModal = new bootstrap.Modal(
            document.getElementById('my-modal'),
            {
                backdrop: true,
            },
        );
        myModal.show();
        document.querySelector('.modal-title').innerText = 'Detail Pendamping';
        const id = e.target.dataset.id;
        try {
            const res = await fetch(
                `${base_url}/guest/detail-pendamping/${id}`,
            );
            const data = await res.json();
            console.log(data);
            const foto =
                data.foto.length > 0
                    ? `https://dpd.asppi.or.id/foto/${data.foto}`
                    : base_url + '/images/person1.png';
            const html = `
      <div class="table-responsive">
        <table class="table table-striped">
          <tr>
            <td colspan="3" class="text-center bg-white">
              <img src="${foto}" class="img-rounded" width="100" height="100"/>
            </td>
          </tr>
          <tr>
            <th>Nama</th>
            <td>:</td>
            <td>${data.nama_pendamping.toUpperCase()}</td>
          </tr>
          <tr>
            <th>DPD</th>
            <td>:</td>
            <td>${data.user.pusat.kd_name}</td>
          </tr>
          <tr>
            <th>Desa</th>
            <td>:</td>
            <td>${data.wisata !== null ? data.wisata.nama_desa : '-'}</td>
          </tr>
          <tr>
            <th>Alamat Desa</th>
            <td>:</td>
            <td style="word-wrap:break-word;">${
                data.wisata !== null ? data.wisata.alamat : '-'
            }</td>
          </tr>
        </table>
      </div>
      `;
            document.querySelector('.modal-body').innerHTML = html;
        } catch (error) {
            console.error(error);
        }
    }
}
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('page-number')) {
        const no = e.target.dataset.number;
        current_page = no;
        const active = document.querySelectorAll('.pagination .page-number');
        active.forEach((item, i) => {
            if (i !== +current_page) {
                item.parentNode.classList.remove('active');
            }
        });
        if (current_page === no) {
            e.target.parentNode.classList.add('active');
        }
        run(no);
    }
});

const filterPusat = document.getElementById('pusat_id');
const btnFilter = document.getElementById('filter');
const btnClose = document.getElementById('button-addon2');
const selectFilter = document.querySelector('.select-filter');
document.addEventListener('DOMContentLoaded', () => {
    run();
    pageNumber();
    filterPusat.addEventListener('change', (e) => {
        // console.log(e.target.value)
        run(1, e.target.value);
        const k = document.querySelectorAll('.page-number');
        k.forEach((item) => ul.removeChild(item.parentNode));
        pageNumber();
    });
    btnFilter.addEventListener('click', (e) => {
        selectFilter.classList.remove('hidden');
        e.target.classList.add('hidden');
    });
    btnClose.addEventListener('click', () => {
        btnFilter.classList.remove('hidden');
        selectFilter.classList.add('hidden');
        run(1, '');
        const k = document.querySelectorAll('.page-number');
        k.forEach((item) => ul.removeChild(item.parentNode));
        pageNumber();
    });
    document.addEventListener('click', detailPendamping);
});
