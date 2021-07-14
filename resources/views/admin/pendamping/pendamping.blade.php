@extends('layouts.adminapp')
@section('header')
@stop
    @section('content')
    <style>
        .modal-lg{
            width: 80%;
        }
    </style>
    <div class="container-fluid" style="margin-top: -10px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Pendamping</h3>
                        <!-- form start -->
                        <form class="form-horizontal" id="formPendamping" method="post" onChange="event.preventDefault()">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4 anggota">
                                        <label for="nama">Anggota *</label>
                                        <button type="button" class="btn btn-success btn-sm " id="btn-tambah-anggota"><i
                                                class="fa fa-search"></i></button>
                                        <input type="text" name="nama_pendamping" id="nama_pendamping"
                                            placeholder="Pilih Anggota" class="form-control" readonly>
                                        <input type="hidden" name="id_pendamping" id="id_pendamping">
                                        <small class="text-danger nama_pendamping"></small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Status *</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Pendamping</option>
                                            <option value="2">Koordinator</option>
                                        </select>
                                        <small class="text-danger status"></small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="wisata_id">Desa Wisata</label>
                                        <select name="wisata_id" id="wisata_id" class="form-control">
                                            <option value="">-Pilih-</option>
                                            @foreach ($wisata as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_desa }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger wisata_id"></small>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer" style="margin-top: -31px">
                                <button type="button" id="simpan" class="btn btn-danger col-md-12"><i
                                        class="fa fa-save"></i>
                                    Simpan</button>
                            </div>
                            <input type="hidden" name="id">
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Data Pendamping</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%" id="table-pendamping" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pendamping</th>
                                        <th>No Telpon</th>
                                        <th>No KTP</th>
                                        <th>Alamat</th>
                                        <th>Foto</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pendamping</th>
                                        <th>No Telpon</th>
                                        <th>No KTP</th>
                                        <th>Alamat</th>
                                        <th>Foto</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal Edit Pendamping-->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" id="formEditPendamping">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Pendamping</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <div class="form-group anggota">
                        <label for="nama">Anggota *</label>
                        <input type="hidden" name="id" id="id">
                        <button type="button" class="btn btn-success btn-sm " id="btn-edit-anggota"><i
                                class="fa fa-search"></i></button>
                        <input type="text" name="nama_pendamping" id="edit_nama_pendamping"
                            placeholder="Pilih Anggota" class="form-control" readonly>
                        <input type="hidden" name="id_pendamping" id="edit_id_pendamping">
                        <small class="text-danger edit_nama_pendamping"></small>
                    </div>
                    <div class="form-group ">
                        <label>Status *</label>
                        <select name="status" id="edit_status" class="form-control">
                            <option value="1">Pendamping</option>
                            <option value="2">Koordinator</option>
                        </select>
                        <small class="text-danger edit_status"></small>
                    </div>
                    <div class="form-group">
                        <label for="wisata_id">Desa Wisata</label>
                        <select name="wisata_id" id="edit_wisata_id" class="form-control">
                            <option value="" selected disabled>-Pilih-</option>
                            @foreach ($wisata as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_desa }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger edit_wisata_id"></small>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-simpan-edit" >Ubah Pendamping</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

    <!-- Modal pilih anggota asppi -->
    <div class="modal fade" id="modal-pilih" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Anggota {{ Auth::user()->satker }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    <input type="hidden" id="pilihKondisi"  />
                    <table class="table-bordered table table-hover responsive" id="table-anggota-pilih" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Foto</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($member as $m)
                                <?php
                                    // if($m->foto == null) {
                                    //     $foto = url('images/person1.png');
                                    // } else {
                                    //     $foto = "https://dpd.asppi.or.id/foto/$m->foto";
                                    // }
                                ?>
                                <tr>
                                    <td> <?php // echo $m->kd_pst.".".$m->kd_daerah.".".$m->no_urut ;?></td>
                                    <td>{{ $m->nama }}</td>
                                    <td><img src="{{ $foto }}" alt="{{ $m->nama }}" width="50" /></td>
                                    <td>{{ $m->email }}</td>
                                    <td><button class="btn btn-success btn-md btn-pilih" data-id="{{ $m->id }}"data-nama="{{ $m->nama }}">Pilih</button></td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    
    @stop
    @section('footer')
    <script>
        const urlMember = "{{ route('pendamping.json-member') }}"
        const url = "{{ url('') }}"
    </script>
    <script src="{{ asset('js/pendamping/script.js') }}"></script>
    @endsection
