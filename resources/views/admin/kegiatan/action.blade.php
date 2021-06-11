<a href="{{ route('kegiatan.financial', $model->id) }}" class="btn btn-info">
    <i class="fa fa-file-text-o"></i>
</a>
<a href="{{ route('kegiatan.show', $model->id) }}" class="btn btn-success">
    <i class="fa fa-file"></i>
</a>
<a href="javascript:void(0)" class="btn btn-danger delete" data-id="{{ $model->id }}">
    <i class="fa fa-trash delete"></i>
</a>
