<a href="javascript:void(0)" class="btn btn-primary update" data-id="{{ $model->id }}">
    <i class="fa fa-edit update"></i>
</a>
<a href="{{ route('project.board', $model->id) }}" class="btn btn-success">
    <i class="fa fa-calendar"></i>
</a>
<a href="{{ route('project.print-laporan',$model->id) }}" class="btn btn-warning" data-id="{{ $model->id }}">
    <i class="fa fa-print"></i>
</a>
<a href="javascript:void(0)" class="btn btn-danger delete" data-id="{{ $model->id }}">
    <i class="fa fa-trash delete"></i>
</a>
