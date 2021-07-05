<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Laporan</title>
        <style type="text/css" media="screen">

            .title{
                text-transform: uppercase;
                font-weight: bold;
                text-align: center;
            }
            .table{
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }
            .table, .table th, .table td{
                border: 1px solid black;
            }
            .table th{
                text-transform: capitalize;
            }
            .tgl{
                text-align: center;
                text-transform: capitalize;
            }
            .tenaga-pendamping{
                text-align: center;
            }
            .tenaga-pendamping p:nth-child(2){
                margin-top: 5em;
            }
            .right-ttd{
                float: right;
            }
            #table-ttd{
                width: 100%;
            }
        </style>
    </head>
    <body>
        @php
            $formatDate = fn($tgl) => date('d-m-Y',strtotime($tgl));
        @endphp
        <h3 class="title">laporan tenaga pendamping</h3>
        <section id="content">
            <table>
                <tr>
                    <td>Nama Desa/Kelurahan</td>
                    <td>:</td>
                    <td>{{ $project->wisata->nama_desa  }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{ $formatDate(request()->query('tgl_start')) . ' - ' . $formatDate(request()->query('tgl_berakhir'))  }}</td>
                </tr>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th>no</th>
                        <th>kegiatan/aktivitas</th>
                        <th>uraian singkat</th>
                        <th>waktu <span>(durasi)</span></th>
                        <th>lokasi</th>
                        <th>jumlah peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($project->kegiatans as $kegiatan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $kegiatan->nama_kegiatan }}</td>
                            <td>{{ $kegiatan->keterangan }}</td>
                            <td>{{ $kegiatan->waktu_durasi }}</td>
                            <td>{{ $kegiatan->lokasi }}</td>
                            <td>{{ $kegiatan->jumlah_peserta }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <section id="ttd">
            <p class="tgl">{{ $project->wisata->nama_desa.','.date('d-m-Y') }}</p>
            <div class="tenaga-pendamping">
                <p>Tenaga Pendamping</p>
                <p>(.......................)</p>
            </div>
            <table id="table-ttd">
                <tr>
                    <td colspan="2" scope"row" style="text-align:center;"></td>
                    <td  style="text-align:center;"></td>
                </tr>
                <tr>
                    <td colspan="2" scope"row" style="text-align:center;"></td>
                    <td  style="text-align:center;"></td>
                </tr>
                <tr>
                    <td style="text-align: center;"> Mengetahui : <br> Kepala Desa / Lurah</td>
                    <td></td>
                    <td style="text-align:center;">Ketua Umum/Direktur <br> Komunitas/Asosiasi/LP2M </td>
                </tr>
                <tr>
                    <td style="text-align:center;"><br><br><br>...................................................</td>
                    <td></td>
                    <td style="text-align:center;"><br><br><br>...................................................</td>
                </tr>
            </table>
        </section>
    </body>
</html>
