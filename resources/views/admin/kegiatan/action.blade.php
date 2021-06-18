<a href="{{ route('laporan-keuangan.index', $model->id) }}" data-toggle="tooltip" data-placement="top" title="Laporan Keuangan" class="btn btn-info">
    <i class="fa fa-usd"></i>
</a>
<a href="{{ route('dokumen.index', $model->id) }}" data-toggle="tooltip" data-placement="top" title="Dokumen Kegiatan" class="btn btn-success">
    <i class="fa fa-file"></i>
</a>
<a href="javascript:void(0)" class="btn btn-danger delete" data-id="{{ $model->id }}">
    <i class="fa fa-trash delete"></i>
</a>
