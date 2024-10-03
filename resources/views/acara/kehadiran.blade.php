<x-layout-dua>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>

    <div class="app-content pt-3 p-md-3 p-lg-4">
	    <div class="container-xl">

            <div class="container">
                <h2>{{ $event->name }} - Absensi</h2>
                <p>Tanggal: {{ $event->date }}</p>
            
                <div class="row">
                    <div class="col-md-6">
                        <video id="video" class="w-100" autoplay></video>
                        <canvas id="canvas" style="display:none;"></canvas>
                        <button id="startButton" class="btn btn-primary mt-2">Mulai Kamera</button>
                        <button id="stopButton" class="btn btn-danger mt-2" style="display:none;">Hentikan Kamera</button>
                    </div>
                    <div class="col-md-6">
                        <form id="manualForm">
                            <div class="form-group">
                                <label for="scannedCode">Kode QR</label>
                                <input type="text" class="form-control" id="scannedCode" name="qr_code">
                            </div>
                            <button type="submit" class="btn btn-primary">Catat Absensi Manual</button>
                        </form>
                    </div>
                </div>
            
                <div id="message" class="alert mt-3" style="display:none;"></div>
            
                <h3 class="mt-4">Daftar Absensi</h3>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Waktu Absensi</th>
                        </tr>
                    </thead>
                    <tbody id="attendanceList">
                        @foreach($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->generus->nama }}</td>
                            <td>{{ $attendance->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
            .then(response => {
                // if (!response.ok) {
                //     throw new Error('Network response was not ok');
                // }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    showMessage(data.error, 'danger');
                } else {
                    showMessage(data.message, 'success');
                    updateAttendanceList(data.student_name, data.attendance_time);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('Terjadi kesalahan saat mencatat absensi.', 'danger');
            });
        }

        function showMessage(message, type) {
            messageDiv.textContent = message;
            messageDiv.className = `alert alert-${type} mt-3`;
            messageDiv.style.display = 'block';
            setTimeout(() => {
                messageDiv.style.display = 'none';
            }, 5000);
        }

        function updateAttendanceList(studentName) {
            const attendanceList = document.getElementById('attendanceList');
            const newRow = attendanceList.insertRow(0);
            const nameCell = newRow.insertCell(0);
            const timeCell = newRow.insertCell(1);
            nameCell.textContent = studentName;
            timeCell.textContent = new Date().toLocaleTimeString();
        }
    });
    </script>
    @endpush

</x-layout-dua>