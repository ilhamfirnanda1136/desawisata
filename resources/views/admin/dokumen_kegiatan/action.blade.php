<a href="{{ route('dokumen.show', $model->id) }}" class="btn btn-info">
    <i class="fa fa-eye"></i>
</a>
<a href="javascript:void(0)" class="btn btn-danger delete" data-id="{{ $model->id }}">
    <i class="fa fa-trash delete"></i>
</a>
