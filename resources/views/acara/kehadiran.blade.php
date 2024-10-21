<x-layout-dua>
    <x-slot:title>{{ auth()->user()->user_verified === 1 ? $title : $title = '404 - Page Not Found' }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            @if (auth()->user()->user_verified === 0)

                <div class="d-flex justify-content-center align-items-center mt-4">
                    <div class="col-md-12 text-center">
                        <h1>404</h1>
                        <h2>Page Not Found</h2>
                        <p>Sorry, the page you are looking for does not exist.</p>
                        <h5><a href="/profile/{{ auth()->id() }}">&laquo; Click here to back to the main page</a></h5>
                    </div>
                </div>

            @else

                <h4>{{ $event->name }} | {{ $event->date }}</h4>

                <div id="message" class="alert mt-3" style="display:none;"></div>
                
                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <video id="video" class="w-100" autoplay></video>
                                <canvas id="canvas" style="display:none;"></canvas>
                                <div class="d-grid gap-2">
                                    <button id="startButton" class="btn app-btn-primary mt-2">Scan QR Code</button>
                                    <button id="stopButton" class="btn app-btn-secondary mt-2" style="display:none;">Stop Scanning</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <span class="text-center">Foto Generus</span>
                            </div>
                            <div class="card-body text-center">
                                <img id="generusFoto" src="" class="img-fluid" style="max-height: 200px;">
                            </div>
                            <div class="card-footer">
                                <span class="text-center" id="generus__nama"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <form id="manualForm">
                            <div class="form-group mb-2">
                                <label for="scannedCode">Kode QR</label>
                                <input type="text" class="form-control" id="scannedCode" name="qr_code">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn app-btn-primary">Catat Absensi Manual</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Total Kehadiran</h4>
                                <div class="stats-figure" id="totalAttendances">{{ $totalAttendances }}</div>
                                <div class="stats-meta text-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Total Kehadiran Laki-laki</h4>
                                <div class="stats-figure" id="attendanceMale">{{ $attendancesByGender['Laki-laki'] ?? 0 }}</div>
                                <div class="stats-meta text-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Total Kehadiran Perempuan</h4>
                                <div class="stats-figure" id="attendanceFemale">{{ $attendancesByGender['Perempuan'] ?? 0 }}</div>
                                <div class="stats-meta text-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <h4 class="stats-type mb-1">Kehadiran per Kelompok</h4>
                                <div class="stats-figure">
                                    <span id="totalGroupsPresent">
                                        {{ $totalGroupsPresent }}
                                    </span>
                                    Kelompok
                                </div>
                                <div class="stats-meta text-success">
                                    <button class="btn btn-sm app-btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal">Lihat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <h3>Daftar Kehadiran</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Generus</th>
                                    <th>Jenis-kelamin</th>
                                    <th>Kelompok</th>
                                    <th>Waktu Absensi</th>
                                </tr>
                            </thead>
                            <tbody id="attendanceList">
                                @foreach($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->generus->nama }}</td>
                                    <td>{{ $attendance->generus->jenis_kelamin }}</td>
                                    <td>{{ $attendance->generus->kelompok->nama }}</td>
                                    <td>{{ $attendance->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
	</div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailModalLabel">Kehadiran per Kelompok</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0" id="attendanceByGroupTable">
                            <thead>
                                <tr>
                                    <th class="meta">Kelompok</th>
                                    <th class="meta">Total</th>
                                    <th class="meta stat-cell">Laki-laki</th>
                                    <th class="meta stat-cell">Perempuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendancesByGroup as $groupName => $stats)
                                    <tr>
                                        <td>{{ $groupName }}</td>
                                        <td class="stat-cell">{{ $stats['total'] }}</td>
                                        <td class="stat-cell">{{ $stats['laki-laki'] }}</td>
                                        <td class="stat-cell">{{ $stats['perempuan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.3.1/dist/jsQR.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const startButton = document.getElementById('startButton');
        const stopButton = document.getElementById('stopButton');
        const manualForm = document.getElementById('manualForm');
        const messageDiv = document.getElementById('message');
        let stream;

        if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
            alert('Untuk menggunakan fitur kamera, harap akses halaman ini melalui HTTPS.');
        }

        startButton.addEventListener('click', startCamera);
        stopButton.addEventListener('click', stopCamera);
        manualForm.addEventListener('submit', handleManualSubmit);

        function startCamera() {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert('Browser Anda tidak mendukung akses kamera. Silakan gunakan browser modern seperti Chrome, Firefox, atau Edge terbaru.');
                return;
            }

            navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
                .then(function(s) {
                    stream = s;
                    video.srcObject = stream;
                    video.play();
                    startButton.style.display = 'none';
                    stopButton.style.display = 'inline-block';
                    scanQRCode();
                })
                .catch(function(err) {
                    console.log("An error occurred: " + err);
                    if (err.name === 'NotAllowedError') {
                        alert('Akses kamera ditolak. Silakan berikan izin untuk mengakses kamera dan coba lagi.');
                    } else if (err.name === 'NotFoundError') {
                        alert('Tidak ada kamera yang ditemukan. Pastikan perangkat Anda memiliki kamera yang berfungsi.');
                    } else {
                        alert('Terjadi kesalahan saat mengakses kamera: ' + err.message);
                    }
                });
        }

        function stopCamera() {
            video.pause();
            video.srcObject = null;
            stream.getTracks().forEach(track => track.stop());
            startButton.style.display = 'inline-block';
            stopButton.style.display = 'none';
        }

        function scanQRCode() {
            if (typeof jsQR === 'undefined') {
                console.error('jsQR library is not loaded');
                alert('Library QR code belum dimuat. Harap muat ulang halaman.');
                return;
            }

            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                canvas.height = video.videoHeight;
                canvas.width = video.videoWidth;
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                var imageData = canvas.getContext('2d').getImageData(0, 0, canvas.width, canvas.height);
                var code = jsQR(imageData.data, imageData.width, imageData.height, {
                    inversionAttempts: "dontInvert",
                });

                if (code) {
                    recordAttendance(code.data);
                    stopCamera();
                    setTimeout(() => {
                        startCamera();
                    }, 1000);
                    return;
                }
            }
            requestAnimationFrame(scanQRCode);
        }

        function handleManualSubmit(e) {
            e.preventDefault();
            const qrCode = document.getElementById('scannedCode').value;
            recordAttendance(qrCode);
        }

        function recordAttendance(qrCode) {
            fetch('{{ route('acara.absensi', $event->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ qr_code: qrCode })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    showMessage(data.error, 'danger');
                } else {
                    showMessage(data.message, 'success');
                    updateAttendanceList(data.generus_nama, data.attendance_time, data.generus_kelompok, data.generus_jenis_kelamin);
                    updateAttendanceStatistics(data);

                    const generusFoto = document.getElementById('generusFoto');
                    generusFoto.src = data.foto;

                    document.getElementById('generus__nama').innerText = data.generus_nama;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('Terjadi kesalahan saat mencatat absensi.', 'danger');
                isScanning = true;
            });
        }

        function showMessage(message, type) {
            messageDiv.textContent = message;
            messageDiv.className = `alert alert-${type} mt-3`;
            messageDiv.style.display = 'block';
            setTimeout(() => {
                messageDiv.style.display = 'none';
            }, 4000);
        }

        function updateAttendanceList(generusName, attendanceTime, kelompok, jenisKelamin) {
            const attendanceList = document.getElementById('attendanceList');
            const newRow = attendanceList.insertRow(0);
            newRow.insertCell(0).textContent = generusName;
            newRow.insertCell(1).textContent = jenisKelamin;
            newRow.insertCell(2).textContent = kelompok;
            newRow.insertCell(3).textContent = attendanceTime;
        }

        function updateAttendanceStatistics(data) {
            document.getElementById('totalAttendances').textContent = data.totalAttendances;
            document.getElementById('totalGroupsPresent').textContent = data.totalGroupsPresent;
            document.getElementById('attendanceMale').textContent = data.attendancesByGender['Laki-laki'];
            document.getElementById('attendanceFemale').textContent = data.attendancesByGender['Perempuan'];

            const attendanceByGroupTable = document.getElementById('attendanceByGroupTable');
            const tbody = attendanceByGroupTable.querySelector('tbody');
            tbody.innerHTML = '';

            Object.entries(data.attendancesByGroup).forEach(([groupName, stats]) => {
                const row = tbody.insertRow();
                row.insertCell(0).textContent = groupName;
                row.insertCell(1).textContent = stats.total;
                row.insertCell(2).textContent = stats['laki-laki'];
                row.insertCell(3).textContent = stats['perempuan'];
            });
        }

        
    });
    </script>
    @endpush
    
</x-layout-dua>