@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tabel Master Jabatan Aparat Desa</h3>
              <div class="pull-right">
                <button class="btn btn-success btn-md btn-tambah"><i class="fa fa-plus"></i> Tambah Jabatan</button></a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="table-jabatan" class="table table-bordered  table-striped">
                <thead>
                <tr>
                  <th width="5%">No</th>
                  <th>Jabatan</th>
                  <th width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                <th>No</th>
                <th>Jabatan</th>
                <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<!-- Modal -->
<div class="modal fade" id="modal-simpan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">00
  <div class="modal-dialog" role="document">
    <form method="post" id="saveJabatan">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="form-group">
            @csrf
            <input type="hidden" name="id" id="id">
           <div class="form-group">
            <label for="nama">Nama Jabatan * </label>
            <input type="text" class="form-control" name="jabatan" id="jabatan" value="" placeholder="Masukkan Nama Lengkap">
            <span class="help-block jabatan"></span>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="save" class="btn btn-primary col-md-12">Simpan</button>
      </div>
    </div>
    </form>
  </div>
</div>

@stop
@section('footer')
<script type="text/javascript">
  function hapusvalidasi(key) 
{
    let pesan=$('#'+key);
    let text=$('.'+key);
    pesan.removeClass('is-invalid');
    text.text(null);
}
  function simpan() {
  	let form=$('#saveJabatan')[0];
  	let formdata=new FormData(form);
  	$.ajax({
  		method :'POST',
  		url : "{{route('aparat.master.simpan')}}",
  		 headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
  		data: formdata,
  		dataType:'JSON',
  		cache: false,
	    contentType: false,
	    processData: false,
	    beforeSend:function() {
	    	loading();
	    },
	    success:function(data){
	    	matikanLoading();
	    	console.log(data);
	    	  if ($.isEmptyObject(data.errors)) 
        	{
        	   $.each(data.success,function(key){
                hapusvalidasi(key);
               });
                swal({
                    title: "Pesan!",
                    text: "Anda Telah Berhasil Membalas !",
                    icon: "success",
                });
                form.reset();
                $('#id').val(null);
                $('#modal-simpan').modal('hide');
                $('#table-jabatan').DataTable().ajax.reload();
        	}
	        else{
	           $.each(data.errors, function (key, value) {
	            hapusvalidasi(key);
	            let pesan = $(`#`+key);
	            let text= $('.'+key);
	            pesan.addClass('is-invalid');
	            text.text(value);
	          });
	           swal({
	                title: "Pesan!",
	                text: "dimohon untuk mengisi semua data!",
	                icon: "error",
	                });
	        }
	    }
  	})
  }
  function refreshTable() {
      $('#table-jabatan').DataTable({
      responsive:true,
      processing:true,
      serverSide:true,
      searching:false,
      ajax:"{{route('aparat.master.table')}}",
      columns:[
          {data:'DT_RowIndex',name:'id'},
          {data:'jabatan',name:'jabatan'},
          {data:'action',name:'action'}
      ]
    });
  }
	$(document).ready(function(){
	   refreshTable();
     $('body').on('click','.btn-delete',function(){
        let hapus=$(this).data('hapus');
        swal({
              title: "Yakin?",
              text: "anda yakin ingin menghapus data ini??",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location=hapus;
              } else {
                swal("Anda membatalkan hapus data");
              }
            });
    });
     $('body').on('click','.btn-edit',function(){
       let id=$(this).data('id');
       let jabatan=$(this).data('jabatan');
       $('#id').val(id)
       $('#jabatan').val(jabatan);
       $('.modal-title').text('Edit Jabatan');
       $('#modal-simpan').modal({backdrop: 'static', keyboard: false})
     });
     $('#save').click(function() {
        simpan();
     });
     $('.btn-tambah').click(function(){
     	$('.modal-title').text('Tambah Jabatan');
     	$('#modal-simpan').modal({backdrop: 'static', keyboard: false})
     });
     $(document).keypress(
	  function(event){
	    if (event.which == '13') {
	      event.preventDefault();
	    }
	});
});

</script>

@endsection