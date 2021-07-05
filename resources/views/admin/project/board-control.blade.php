@extends('layouts.adminapp')
@section('header')
@stop
@section('content')
    <style>
        .center {
            /* margin: 0 -2% 0 2.5%; */
        }

        .tgl {
            padding: 1rem;
            margin: 10px 3px 3px 5px;
            box-shadow: 2px 2px black;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            font-size: 25pt;
        }

        .tgl:hover {
            color: white;
            box-shadow: 5px 5px black;
        }

    </style>
    <div class="container-fluid" style="margin-top: -10px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Papan Kontrol Proyek</h3>
                            <button onclick="window.history.back()" type="button" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                                Kembali
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="center">
                            <h3 class="text-center"><b>Tanggal Project</b></h3>
                            <div class="d-flex flex-wrap justify-content-center">
                                
                                @php
                                    $start = new DateTime($data->tgl_start);
                                    $finish = new DateTime($data->tgl_finish);
                                    $dayBetween = $start->diff($finish)->days + 1;
                                @endphp
                                @if ($start <= $finish)
                                    @for ($i = 0; $i < $dayBetween; $i++)
                                    @php
                                        $dataKegiatan = $kegiatan->with('dokumenKegiatans', 'laporanKeuangans')->where('project_id',$data->id)->where('tanggal',date('d-m-Y', strtotime('+' . $i . ' day', strtotime($data->tgl_start))))->get();
                                        // var_dump($dataKegiatan->dokumenKegiatans);
                                        $color = '#007BFF';
                                    @endphp
                                    @foreach ($dataKegiatan as $item)
                                        @if (!$dataKegiatan->isEmpty() && $item->dokumenKegiatans->isEmpty())
                                            @php
                                                $color = 'yellow';
                                            @endphp
                                        @elseif (!$item->dokumenKegiatans->isEmpty() && $item->laporanKeuangans->isEmpty())
                                            @php
                                                $color = 'orange';
                                            @endphp
                                        @elseif (!$item->laporanKeuangans->isEmpty() && !$item->dokumenKegiatans->isEmpty())
                                            @php
                                                $color = 'green';
                                            @endphp
                                        @endif
                                    @endforeach
                                        <a href="{{ url('/kegiatan/' . $data->id . '/' . date('d-m-Y', strtotime('+' . $i . ' day', strtotime($data->tgl_start)))) }}"
                                            class="tgl" style="background-color: {{ $color }}; border:1px solid {{ $color }};">
                                            {{ date('d/m', strtotime('+' . $i . ' day', strtotime($data->tgl_start))) }}
                                        </a>
                                    @endfor
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer')
    <script src="{{ asset('js/project/index.js') }}"></script>
@endsection
