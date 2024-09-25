<div>
    <h2>Daftar Generus</h2>
    <div class="mb-3">
        <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Cari siswa...">
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Umur</th>
                <th>Kelompok</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($generuses as $generus)
                <tr>
                    <td>{{ $generus->nama }}</td>
                    <td>{{ $generus->tanggal_lahir }}</td>
                    <td>{{ $generus->kelompok->nama }}</td>
                    <td>{{ $generus->jenis_kelamin }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Edit</button>
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $generuses->links() }}
</div>