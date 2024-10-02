<div>
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
            <form wire:submit.prevent="recordAttendance">
                <div class="form-group">
                    <label for="scannedCode">Kode QR</label>
                    <input type="text" class="form-control" id="scannedCode" wire:model.defer="scannedCode">
                </div>
                <button type="submit" class="btn btn-primary">Catat Absensi Manual</button>
            </form>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    <h3 class="mt-4">Daftar Absensi</h3>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Waktu Absensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->generus->nama }}</td>
                    <td>{{ $attendance->attended_at->format('H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ... daftar absensi ... -->

    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.3.1/dist/jsQR.min.js"></script>
    <script type="text/javascript">
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const startButton = document.getElementById('startButton');
            const stopButton = document.getElementById('stopButton');
            let stream;

            startButton.addEventListener('click', startCamera);
            startButton.addEventListener('click', function() {
                console.log('kamera ok');
            });
            stopButton.addEventListener('click', stopCamera);

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
                if (video.readyState === video.HAVE_ENOUGH_DATA) {
                    canvas.height = video.videoHeight;
                    canvas.width = video.videoWidth;
                    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                    var imageData = canvas.getContext('2d').getImageData(0, 0, canvas.width, canvas.height);
                    var code = jsQR(imageData.data, imageData.width, imageData.height, {
                        inversionAttempts: "dontInvert",
                    });
                    if (code) {
                        @this.scanQrCode(code.data);
                    }
                }
                requestAnimationFrame(scanQRCode);
            }
    </script>
</div>