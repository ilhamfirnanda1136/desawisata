<button data-id="{{$model->id}}" data-idanggota="{{ $model->id_anggota }}" data-nama="{{ $model->nama_pendamping }}" data-status="{{ $model->status }}" data-wisata="{{ $model->wisata_id }}"  class="btn-primary btn-sm btn btn-edit"><i class="fa fa-pencil"></i></button> 
@if($model->user_id == Auth::user()->id)
<a href="#" data-id="{{$model->id}}"  onclick="event.preventDefault()" class="btn-danger btn btn-sm btn-delete"><i class="fa fa-trash"></i></a>
@endif