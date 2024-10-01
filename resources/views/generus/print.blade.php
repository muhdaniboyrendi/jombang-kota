<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Generus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex align-items-center vh-100">
        <div class="card" style="width: 65rem">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table mb-0 table-hover">
                                <tr>
                                    <td>Nama</td>
                                    <th>{{ $generus->nama }}</th>
                                </tr>
                                <tr>
                                    <td>Tempat dan Tanggal Lahir</td>
                                    <th>{{ $generus->tempat_lahir }}, {{ $generus->tanggal_lahir }}</th>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <th>{{ $generus->jenis_kelamin }}</th>
                                </tr>
                                <tr>
                                    <td>Kelas / Status</td>
                                    <th>{{ $generus->kelas }}</th>
                                </tr>
                                <tr>
                                    <td>Sekolah</td>
                                    <th>{{ $generus->sekolah }}</th>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <th>{{ $generus->pekerjaan }}</th>
                                </tr>
                                <tr>
                                    <td>Nama Ayah</td>
                                    <th>{{ $generus->bapak }}</th>
                                </tr>
                                <tr>
                                    <td>Nama Ibu</td>
                                    <th>{{ $generus->ibu }}</th>
                                </tr>
                                <tr>
                                    <td>Desa</td>
                                    <th>{{ $generus->desa->nama }}</th>
                                </tr>
                                <tr>
                                    <td>Kelompok</td>
                                    <th>{{ $generus->kelompok->nama }}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div>{!! $generus->qr_code_image !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>