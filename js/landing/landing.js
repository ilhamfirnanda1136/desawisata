async function initMap() {
  try {
    const res = await fetch(url);
    const data = await res.json();
    const indonesia = {lat: -1.4606101575093966, lng: 116.71025356048715};
    const map = new google.maps.Map(document.getElementById('map'), {
      zoom: 5,
      center: indonesia,
    });
    data.forEach((item) => {
      const marker = new google.maps.Marker({
        position: {
          lat: parseFloat(item.latitude),
          lng: parseFloat(item.langtitude),
        },
        map: map,
      });
      const infoWindow = new google.maps.InfoWindow({
        content: `
    <p>
        <i class="fa fa-home"></i>
        <b>Desa : ${item.nama_desa.toUpperCase()}</b>
    <p>
        <i class="fa fa-home"></i>
        <b>Alamat : ${item.alamat}</b>
    </p>
    `,
      });
      marker.addListener('click', () => {
        infoWindow.open(map, marker);
      });
    });
  } catch (error) {
    console.error(error);
  }
}

const handleDetail = (e) => {
  if (e.target.classList.contains('detail')) {
    const myModal = new bootstrap.Modal(
      document.getElementById('my-modal'),
      {
        backdrop: true,
      },
    );
    myModal.show();
    const id = e.target.dataset.id;
    document.getElementById('modal-table').innerHTML = '';
    const g = new gridjs.Grid({
      columns: [{name: '#'}, {name: 'Nama Desa'}],
      resizable: true,
      search: true,
      pagination: true,
      server: {
        url: `${base_url}/api/desa/wisata/${id}`,
        then: (data) =>
          data.wisata !== undefined
            ? data.wisata.map((item, i) => [i + 1, item.nama_desa])
            : '',
      },
    })
      .render(document.getElementById('modal-table'))
      .forceRender();
    // g.updateConfig({
    //   search: true,
    // }).forceRender()
  }
};
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
            <td style="word-wrap:break-word;">${data.wisata !== null ? data.wisata.alamat : '-'
        }</td>
          </tr>
        </table>
      </div>
      `;
      document.querySelector('.modal-body').innerHTML = html;
      console.log(data);
    } catch (error) {
      console.error(error);
    }
  }
}
document.addEventListener('click', detailPendamping);
document.addEventListener('click', handleDetail);
