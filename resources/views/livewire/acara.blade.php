<div>
    <h2>{{ $event->name }} - Absensi</h2>
    <p>Tanggal: {{ $event->date->format('d M Y') }}</p>

    <form wire:submit.prevent="scanQrCode">
        <div class="form-group">
            <label for="scannedCode">Scan QR Code</label>
            <input type="text" class="form-control" id="scannedCode" wire:model.defer="scannedCode" autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Catat Absensi</button>
    </form>

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
</div>