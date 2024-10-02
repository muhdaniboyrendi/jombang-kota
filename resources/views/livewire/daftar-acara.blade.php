<div>
    <h2>Acara</h2>
    <div class="card">

        <div class="card-body">

            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <div class="row gx-1 row-md gy-1">
                                <div class="col-md">
                                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Cari Acara...">
                                </div>
                                <div class="col-auto">	
                                    <!-- Button trigger modal -->
                                    <a href="acara-tambah" class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#inputModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                                        </svg>
                                        Tambah Acara
                                    </a>
                                </div>
                            </div>
                                
                        </div><!--//col-->
                        
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
                                        'name' => 'name',
                                        'displayName' => 'Nama Acara'
                                    ])
                                    @include('livewire.includes.table-sort-th', [
                                        'name' => 'date',
                                        'displayName' => 'Tanggal'
                                    ])
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr wire:key="{{ $event->id }}">
                                        <td class="align-middle">{{ $event->name }}</td>
                                        <td class="align-middle">{{ $event->date }}</td>
                                        <td class="align-middle">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ route('event.attendance', $event->id) }}" class="btn btn-sm app-btn-primary">Absensi</a>
                                                <button type="button" wire:click="delete({{ $event->id }})" class="btn btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>

                </div>
            </div>

            <div class="mt-3">
                <div class="row">
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
            {{ $events->links() }}

        </div>

    </div>


    <!-- Modal -->
    {{-- Tambah Modal --}}
    <div>
        <div wire:ignore.self class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputModalLabel">Tambah Acara</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form wire:submit.prevent="store">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Acara</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.lazy="name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal Acara</label>
                                <input type="text" class="form-control @error('date') is-invalid @enderror" id="date" wire:model.lazy="date">
                                @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi Acara</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model.lazy="description">
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn app-btn-primary">Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div>
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border border-danger">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Acara</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span>Anda yakin ingin menghapus acara <strong>{{ $name }}</strong> ?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="destroy" class="btn btn-sm app-btn-primary" data-bs-dismiss="modal">Hapus</button>
                        <button type="button" class="btn btn-sm app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End Modal --}}

</div>