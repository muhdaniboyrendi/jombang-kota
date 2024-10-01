<div>
    <h2>Daftar Acara</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Acara</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->date->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('event.attendance', $event->id) }}" class="btn btn-primary">Absensi</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>