<div>
    <h2>Generus</h2>
    <div class="card">

        <div class="card-body">
            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <div class="row gx-1">
                                <div class="col-auto">
                                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Cari siswa...">
                                </div>
                                <div class="col-auto">
                                    <select wire:model.live="kelompok" class="form-select w-auto" >
                                        <option value="">All</option>
                                        @foreach ($kelompoks as $kelompok)
                                            <option value="{{ $kelompok->nama }}">{{ $kelompok->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                
                        </div><!--//col-->
                        <div class="col-auto">						    
                            <a class="btn app-btn-primary" href="/tambahgenerus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                                Tambah Generus
                            </a>
                        </div>
                    </div><!--//row-->
                </div><!--//table-utilities-->
            </div><!--//col-auto-->

            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover text-left">
                            <thead>
                                <tr>
                                    @include('livewire.includes.table-sort-th', [
                                        'name' => 'nama',
                                        'displayName' => 'Nama'
                                    ])
                                    <th>Umur</th>
                                    @include('livewire.includes.table-sort-th', [
                                        'name' => 'kelompok_id',
                                        'displayName' => 'Kelompok'
                                    ])
                                    <th>Jenis Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">Erlan</td>
                                    <td class="align-middle">21</td>
                                    <td class="align-middle">Banjarsari</td>
                                    <td class="align-middle">Laki-laki</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-sm app-btn-secondary">Left</button>
                                            <button type="button" class="btn btn-sm app-btn-secondary">Middle</button>
                                            <button type="button" class="btn btn-sm app-btn-secondary">Right</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Khaysa</td>
                                    <td class="align-middle">12</td>
                                    <td class="align-middle">Banjarsari</td>
                                    <td class="align-middle">Laki-laki</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-sm app-btn-secondary">Left</button>
                                            <button type="button" class="btn btn-sm app-btn-secondary">Middle</button>
                                            <button type="button" class="btn btn-sm app-btn-secondary">Right</button>
                                        </div>
                                    </td>
                                </tr>
                                @foreach ($generuses as $generus)
                                    <tr wire:key="{{ $generus->id }}">
                                        <td class="align-middle">{{ $generus->nama }}</td>
                                        <td class="align-middle">{{ $generus->tanggal_lahir }}</td>
                                        <td class="align-middle">{{ $generus->kelompok->nama }}</td>
                                        <td class="align-middle">{{ $generus->jenis_kelamin }}</td>
                                        <td class="align-middle">
                                            <button class="btn btn-sm btn-primary">Edit</button>
                                            <button wire:click="delete({{ $generus->id }})" class="btn btn-sm btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>

                </div>
            </div>

            <div class="mt-3">
                <div class="row mb-3">
                    <label for="perPage" class="col-sm-1 col-form-label">Per Page</label>
                    <div class="col-sm-2">
                        <select wire:model.live='perPage' class="form-select" id="perPage">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
            </div>
            {{ $generuses->links() }}

        </div>

    </div>
</div>