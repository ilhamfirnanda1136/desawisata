const grid = new gridjs.Grid({
  columns: [
    {
      name: 'rowIndex',
      hidden: true,
    },
    { name: '#' },
    'provinsi',
    {
      name: 'actions',
      formatter: (_, row) =>
        gridjs.html(
          `<button class="btn btn-info text-white detail" data-id="${row.cells[0].data}">Detail</button>`,
        ),
    },
  ],
  resizable: true,
  search: true,
  pagination: true,
  server: {
    url: `${base_url}/api/pusat/json`,
    then: (data) => data.map((item, i) => [item.id, i + 1, item.kd_name, null]),
  },
}).render(document.getElementById('table'))

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
