async function initMap() {
  try {
    const res = await axios(url)
    const data = res.data
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

function init() {}
document.addEventListener('DOMContentLoaded', init)
