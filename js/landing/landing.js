async function initMap() {
  try {
    const res = await fetch(url)
    const data = await res.json()
    const indonesia = { lat: -1.4606101575093966, lng: 116.71025356048715 }
    const map = new google.maps.Map(document.getElementById('map'), {
      zoom: 5,
      center: indonesia,
    })
    data.forEach((item) => {
      const marker = new google.maps.Marker({
        position: {
          lat: parseFloat(item.latitude),
          lng: parseFloat(item.langtitude),
        },
        map: map,
      })
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
      })
      marker.addListener('click', () => {
        infoWindow.open(map, marker)
      })
    })
  } catch (error) {
    console.error(error)
  }
}

const handleDetail = (e) => {
  if (e.target.classList.contains('detail')) {
    const myModal = new bootstrap.Modal(document.getElementById('my-modal'), {
      backdrop: true,
    })
    myModal.show()
    const id = e.target.dataset.id
    document.getElementById('modal-table').innerHTML = ''
    const g = new gridjs.Grid({
      columns: [{ name: '#' }, { name: 'Nama Desa' }],
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
      .forceRender()
    // g.updateConfig({
    //   search: true,
    // }).forceRender()
  }
}
document.addEventListener('click', handleDetail)
