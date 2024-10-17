<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Generus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .card-siswa {
            width: 53.98mm; /* KTP size width */
            height: 85.60mm; /* KTP size height */
            border: 1px solid #000;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px auto;
            page-break-inside: avoid; /* Avoid breaking inside the card */
        }
        .header {
            text-align: center;
            font-weight: bold;
        }
        .qr-code {
            width: 60px;
            height: 60px;
        }
        .student-info {
            font-size: 12px;
            margin-top: 10px;
        }
        .student-info p {
            margin-bottom: 4px;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
        }

        /* Style specifically for printing */
        @media print {
            .print-btn {
                display: none;
            }

            /* Ensure 9 cards per page (3 rows, 3 columns) */
            .container-fluid {
                display: grid;
                grid-template-columns: repeat(3); /* 3 cards per row */
                grid-template-rows: repeat(3, auto);   /* 2 rows per page */
                gap: 10px;
                justify-items: center;
                align-items: center;
                padding: 0;
            }

            /* Ensure consistent card sizing for printing */
            .card-siswa {
                margin: 0;
                width: 53.98mm;
                height: 85.60mm;
            }

            /* Prevent page breaks inside the card */
            .container-fluid > div {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            /* Ensure exactly 6 cards per page */
            .container-fluid > div:nth-of-type(6n+1) {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
    <button class="btn btn-primary mb-4 print-btn" onclick="window.print()">Cetak</button>

    <div class="container-fluid">
        <div class="row justify-content-center">
            @foreach ($generuses as $generus)
                <div class="col-4">
                    <div class="card-siswa text-center">
                        <!-- Header (Judul Kartu) -->
                        <div class="header">
                            <h6>Kartu Generus</h6>
                        </div>
                    
                        <!-- Informasi Siswa -->
                        <div class="student-info text-start mt-3">
                            <p><strong>Nama:</strong> {{ $generus->nama }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $generus->jenis_kelamin }}</p>
                            <p><strong>Desa:</strong> {{ $generus->desa->nama }}</p>
                            <p><strong>Kelompok:</strong> {{ $generus->kelompok->nama }}</p>
                        </div>
                    
                        <!-- QR Code -->
                        <div class="footer">
                            {!! $generus->qr_code_image !!}
                            <p class="mt-2" style="font-size: 10px;">{{ $generus->qr_code }}</p>
                            <p class="mt-2" style="font-size: 10px;">Scan untuk Absensi</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
