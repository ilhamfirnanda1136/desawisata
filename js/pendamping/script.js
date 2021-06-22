class pendamping {
  /* variable element */
  static DOMStrings = {
    btnTambahAnggota: '#btn-tambah-anggota',
    btnEditAnggota: '#btn-edit-anggota',
    modalPilih: '#modal-pilih',
    modalEdit: '#modal-edit',
    pilihKondisi: '#pilihKondisi',
    btnPilihAnggota: '.btn-pilih',
    tableAnggota: '#table-anggota-pilih',
    idPendamping: '#id_pendamping',
    namaPendamping: '#nama_pendamping',
    editIdPendamping: '#edit_id_pendamping',
    editNamaPendamping: '#edit_nama_pendamping',
    editStatus: '#edit_status',
    tablePendamping: '#table-pendamping',
    formPendamping: '#formPendamping',
    formEditPendamping: '#formEditPendamping',
    btnSimpan: '#simpan',
    idEdit: '#id',
    btnEditSimpan: '#btn-simpan-edit',
    btnEdit: '.btn-edit',
    btnDelete: '.btn-delete',
  }

  static loadAnggota = () => {
    $(this.DOMStrings.tableAnggota).DataTable()
  }

  static openAnggota = (edit = 'tambah') => {
    $(this.DOMStrings.pilihKondisi).val(edit)
    $(this.DOMStrings.modalPilih).modal({ backdrop: 'static' })
  }

  static PilihAnggota = (event) => {
    if ($(this.DOMStrings.pilihKondisi).val() == 'tambah') {
      $(this.DOMStrings.idPendamping).val(event.data('id'))
      $(this.DOMStrings.namaPendamping).val(event.data('nama'))
    } else {
      $(this.DOMStrings.editIdPendamping).val(event.data('id'))
      $(this.DOMStrings.editNamaPendamping).val(event.data('nama'))
    }
    $(this.DOMStrings.modalPilih).modal('hide')
  }

  static loadPendamping = () => {
    $(this.DOMStrings.tablePendamping).DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: process_env_url + '/pendamping/table/',
      columns: [
        { data: 'DT_RowIndex', name: 'id' },
        { data: 'nama_pendamping', name: 'nama_pendamping' },
        { data: 'notelp', name: 'notelp' },
        { data: 'ktp', name: 'ktp' },
        {
          data: 'alamat',
          name: 'alamat',
          render: (data) => data ?? 'Belum ada alamat',
        },
        { data: 'foto_pendamping', name: 'foto_pendamping' },
        { data: 'status_data', name: 'status_data' },
        { data: 'action', name: 'action' },
      ],
      order: [[0, 'desc']],
    })
  }

  static openEdit = (event) => {
    $(this.DOMStrings.idEdit).val(event.data('id'))
    $(this.DOMStrings.editIdPendamping).val(event.data('idanggota'))
    $(this.DOMStrings.editNamaPendamping).val(event.data('nama'))
    $(this.DOMStrings.editStatus).val(event.data('status'))
    $(this.DOMStrings.modalEdit).modal({ backdrop: 'static' })
  }

  static simpanPendamping = async (menu, edit = false) => {
    loading()
    // const form =
    //   menu === 'tambah'
    //     ? document.querySelector(this.DOMStrings.formPendamping)
    //     : document.querySelector(this.DOMStrings.formEditPendamping)
    const form = document.querySelector(this.DOMStrings.formPendamping)
    const formData = new FormData(form)
    const url = process_env_url + '/simpan/pendamping'
    try {
      const response = await axios({
        method: 'post',
        data: formData,
        url: url,
      })
      matikanLoading()
      let icon = ''
      const data = await response.data
      console.log(data)
      if (data.errors === undefined) {
        const success = Object.entries(data.success)
        success.map(([key, value]) => {
          hapusvalidasi(key, edit)
        })
        icon = 'success'
        swal({
          title: 'Pesan!',
          text: data.message,
          icon: icon,
        })
        $(this.DOMStrings.tablePendamping).DataTable().ajax.reload()
        $(this.DOMStrings.formPendamping)[0].reset()
      } else {
        const error = Object.entries(data.errors)
        error.map(([key, value]) => {
          hapusvalidasi(key, edit)
          tambahvalidasi(key, value, edit)
          icon = 'error'
        })
        swal({
          title: 'Pesan!',
          text: data.message,
          icon: icon,
        })
      }
    } catch (error) {
      matikanLoading()
      alert('Maaf ada kesalahan diserver')
      console.log(error)
    }
  }

  static hapusData = (id) => {
    swal({
      title: 'Yakin?',
      text: 'anda yakin ingin menghapus data pendamping ini??',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        loading()
        fetch(`${process_env_url}/pendamping/hapus/${id}`)
          .then((res) => res.json())
          .then((data) => {
            matikanLoading()
            swal({
              title: 'Pesan!',
              text: data.message,
              icon: 'success',
            })
            $(this.DOMStrings.tablePendamping).DataTable().ajax.reload()
          })
          .catch((err) => console.error(err))
      } else {
        swal('Anda membatalkan hapus data')
      }
    })
  }
}

document.addEventListener('DOMContentLoaded', function () {
  pendamping.loadAnggota()
  pendamping.loadPendamping()

  const btnTambahAnggota = document.querySelector(
    pendamping.DOMStrings.btnTambahAnggota,
  )
  btnTambahAnggota.addEventListener('click', function () {
    pendamping.openAnggota()
  })

  const btnEditAnggota = document.querySelector(
    pendamping.DOMStrings.btnEditAnggota,
  )
  btnEditAnggota.addEventListener('click', function () {
    pendamping.openAnggota('edit')
  })

  $('body').on('click', pendamping.DOMStrings.btnPilihAnggota, function () {
    pendamping.PilihAnggota($(this))
  })

  const btnSimpan = document.querySelector(pendamping.DOMStrings.btnSimpan)
  btnSimpan.addEventListener('click', function () {
    pendamping.simpanPendamping('tambah', false)
  })

  $('body').on('click', pendamping.DOMStrings.btnEdit, function () {
    pendamping.openEdit($(this))
  })
  const btnEditSimpan = document.querySelector(
    pendamping.DOMStrings.btnEditSimpan,
  )
  btnEditSimpan.addEventListener('click', function () {
    pendamping.simpanPendamping('edit', true)
  })

  $('body').on('click', pendamping.DOMStrings.btnDelete, function () {
    pendamping.hapusData($(this).data('id'))
  })
})
