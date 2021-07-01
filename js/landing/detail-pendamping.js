let current_page = 1
let last_page = 0
function getData(page, filter) {
  return new Promise((resolve) => {
    resolve(fetch(`${base_url}/api/desa/pendamping?page=${page}&dpd=${filter}`))
  })
}

async function run(page = 1, filter = '') {
  const res = await getData(page, filter)
  const data = await res.json()
  console.log(data)
  last_page = data.pendamping.last_page
  renderCard(data.pendamping.data)
}

function renderCard(data) {
  const row = document.querySelector('.row')
  let render = ''
  data.forEach((item) => {
    const foto =
      item.foto.length > 0
        ? `https://dpd.asppi.or.id/foto/${item.foto}`
        : base_url + 'images/person1.png'
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
            </div>
        </div>
    </div>
        `
    render += html
  })
  row.innerHTML = render
}

let index = 1
async function firstPage() {
  run(1)
}
async function lastPage() {
  //   console.log(i + 1)
  run(last_page)
}

async function pageNumber() {
  const res = await getData()
  const data = await res.json()
  const ul = document.querySelector('.pagination')
  for (let i = 1; i < data.pendamping.last_page + 1; i++) {
    const numberPage = document.createElement('li')
    numberPage.setAttribute('class', 'page-item')
    const a = document.createElement('a')
    a.setAttribute('href', 'javascript:void(0)')
    a.setAttribute('class', 'page-link page-number')
    a.setAttribute('data-number', i)
    // a.setAttribute('data-page', data.pendamping.current_page)
    const aText = document.createTextNode(i)
    a.appendChild(aText)
    numberPage.appendChild(a)
    const totalLi = document.querySelectorAll('.page-item').length
    const li = ul.querySelector(`li:nth-child(${totalLi})`)
    ul.insertBefore(numberPage, li)
  }
}
document.addEventListener('click', (e) => {
  if (e.target.classList.contains('page-number')) {
    const no = e.target.dataset.number
    current_page = no
    const active = document.querySelectorAll('.pagination .page-number')
    active.forEach((item, i) => {
      if (i !== +current_page) {
        item.parentNode.classList.remove('active')
      }
    })
    if (current_page === no) {
      e.target.parentNode.classList.add('active')
    }
    run(no)
  }
})

const filterPusat = document.getElementById('pusat_id')
filterPusat.addEventListener('change', (e) => {
  console.log(e.target.value)
  run(1, e.target.value)
})
const btnFilter = document.getElementById('filter')
const btnClose = document.getElementById('button-addon2')
const selectFilter = document.querySelector('.select-filter')
btnFilter.addEventListener('click', (e) => {
  selectFilter.classList.remove('hidden')
  e.target.classList.add('hidden')
})
btnClose.addEventListener('click', () => {
  btnFilter.classList.remove('hidden')
  selectFilter.classList.add('hidden')
})
pageNumber()
run()
