<div>
    <h2>{{ $event->name }} - Absensi</h2>
    <p>Tanggal: {{ $event->date }}</p>

    <div class="row">
        
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
    
</div>