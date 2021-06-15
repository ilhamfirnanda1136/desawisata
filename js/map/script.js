async function initMap() {
  try {
    const res = await axios(url)
    const data = res.data
    const indonesia = { lat: -4.3602932248789275, lng: 122.38943196612955 }
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
    })
  } catch (error) {
    console.error(error)
  }
}

function init() {}
document.addEventListener('DOMContentLoaded', init)
