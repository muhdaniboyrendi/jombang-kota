<div>
    <h2>Generus</h2>
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
                            <div class="row gx-1">
                                <div class="col-auto">
                                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Cari Generus...">
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
                            <a class="btn app-btn-primary" href="/generus-tambah">
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
                                    <th>Kelas/Status</th>
                                    @include('livewire.includes.table-sort-th', [
                                        'name' => 'kelompok_id',
                                        'displayName' => 'Kelompok'
                                    ])
                                    <th>Jenis Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($generuses as $generus)
                                    <tr wire:key="{{ $generus->id }}">
                                        <td class="align-middle">{{ $generus->nama }}</td>
                                        <td class="align-middle">{{ $generus->kelas }}</td>
                                        <td class="align-middle">{{ $generus->kelompok->nama }}</td>
                                        <td class="align-middle">{{ $generus->jenis_kelamin }}</td>
                                        <td class="align-middle">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" wire:click="modal({{ $generus->id }})" class="btn btn-sm app-btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal">Info</button>
                                                <button type="button" wire:click="modal({{ $generus->id }})" class="btn btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                                <button type="button" wire:click="modal({{ $generus->id }})" class="btn btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
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
            {{ $generuses->links() }}

        </div>

    </div>


    <!-- Modal -->
    {{-- Delete Modal --}}
    <div>
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border border-danger">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Generus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if($dataDetails)
                            <span>Anda yakin ingin menghapus data <strong>{{ $dataDetails->nama }}</strong>?</span>
                        @else
                            <span>Loading data...</span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="delete({{ $dataId }})" class="btn btn-sm app-btn-primary" data-bs-dismiss="modal">Hapus</button>
                        <button type="button" class="btn btn-sm app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Info Modal --}}
    <div>
        <div wire:ignore.self class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel">Detail Generus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if($dataDetails)
							<div class="table-responsive">
								<table class="table mb-0 table-hover">
                                    <tr>
                                        <td>Nama</td>
                                        <th>{{ $dataDetails->nama }}</th>
                                    </tr>
                                    <tr>
                                        <td>Tempat dan Tanggal Lahir</td>
                                        <th>{{ $dataDetails->tempat_lahir }}, {{ $dataDetails->tanggal_lahir }}</th>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <th>{{ $dataDetails->jenis_kelamin }}</th>
                                    </tr>
                                    <tr>
                                        <td>Kelas / Status</td>
                                        <th>{{ $dataDetails->kelas }}</th>
                                    </tr>
                                    <tr>
                                        <td>Sekolah</td>
                                        <th>{{ $dataDetails->sekolah }}</th>
                                    </tr>
                                    <tr>
                                        <td>Pekerjaan</td>
                                        <th>{{ $dataDetails->pekerjaan }}</th>
                                    </tr>
                                    <tr>
                                        <td>Nama Ayah</td>
                                        <th>{{ $dataDetails->bapak }}</th>
                                    </tr>
                                    <tr>
                                        <td>Nama Ibu</td>
                                        <th>{{ $dataDetails->ibu }}</th>
                                    </tr>
								</table>
							</div><!--//table-responsive-->
                        @else
                            <p>Loading data...</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="modal({{ $dataId }})" class="btn btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div>
        <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Detail Generus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if($dataDetails)
                            <form wire:submit.prevent="store">
                                <div class="row">
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" wire:model.lazy="nama" value="{{ $dataDetails->nama }}">
                                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="kelas" class="form-label">Kelas / Status</label>
                                            <select class="form-select  @error('kelas') is-invalid @enderror" name="kelas" id="kelas" wire:model.lazy="kelas">
                                                <option value="PAUD">PAUD</option>
                                                <option value="1 SD">1 SD</option>
                                                <option value="2 SD">2 SD</option>
                                                <option value="3 SD">3 SD</option>
                                                <option value="4 SD">4 SD</option>
                                                <option value="5 SD">5 SD</option>
                                                <option value="6 SD">6 SD</option>
                                                <option value="1 SMP">1 SMP</option>
                                                <option value="2 SMP">2 SMP</option>
                                                <option value="3 SMP">3 SMP</option>
                                                <option value="1 SMA/SMK">1 SMA/SMK</option>
                                                <option value="2 SMA/SMK">2 SMA/SMK</option>
                                                <option value="3 SMA/SMK">3 SMA/SMK</option>
                                                <option value="Kuliah" {{ $dataDetails->kelas == 'Kuliah' ? 'selected' : '' }}>Kuliah</option>
                                                <option value="Bekerja">Bekerja</option>
                                                <option value="Mondok">Mondok</option>
                                            </select>
                                            @error('kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" wire:model.lazy="tempat_lahir" value="{{ $dataDetails->tempat_lahir }}">
                                            @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" wire:model.lazy="tanggal_lahir" value="{{ $dataDetails->tanggal_lahir }}">
                                            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="sekolah" class="form-label">Sekolah (opsional)</label>
                                            <input type="text" class="form-control @error('sekolah') is-invalid @enderror" id="sekolah" wire:model.lazy="sekolah" value="{{ $dataDetails->sekolah }}">
                                            @error('sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="pekerjaan" class="form-label">Pekerjaan (opsional)</label>
                                            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" wire:model.lazy="pekerjaan" value="{{ $dataDetails->pekerjaan }}">
                                            @error('pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="bapak" class="form-label">Nama Bapak</label>
                                            <input type="text" class="form-control @error('bapak') is-invalid @enderror" id="bapak" wire:model.lazy="bapak" value="{{ $dataDetails->bapak }}">
                                            @error('bapak') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="ibu" class="form-label">Nama Ibu</label>
                                            <input type="text" class="form-control @error('ibu') is-invalid @enderror" id="ibu" wire:model.lazy="ibu" value="{{ $dataDetails->ibu }}">
                                            @error('ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="desa" class="form-label">Desa</label>
                                            <select class="form-select" id="desa" wire:model.live="desa_id">
                                                <option value="">Pilih Desa</option>
                                                @foreach ($editDesas as $desa)
                                                    <option value="{{ $desa->id }}" {{ $desa->id == $dataDesa->desa_id ? 'selected' : '' }}>{{ $desa->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('desa_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="mb-3">
                                            <label for="kelompok" class="form-label">Kelompok</label>
                                            <select class="form-select @error('kelompok_id') is-invalid @enderror" name="kelompok_id" id="kelompok" wire:model.live="kelompok_id">
                                                <option value="">Pilih Kelompok</option>
                                                @foreach ($editKelompoks as $kelompok)
                                                    <option value="{{ $kelompok->id }}" {{ $kelompok->id == $dataDetails->kelompok_id ? 'selected' : '' }}>{{ $kelompok->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('kelompok_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-4">
                                        <div>
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" value="Laki-laki" type="radio" name="jenis_kelamin" id="laki-laki" wire:model.lazy="jenis_kelamin" {{ $dataDetails->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="laki-laki">
                                                Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" value="Perempuan" type="radio" name="jenis_kelamin" id="perempuan" wire:model.lazy="jenis_kelamin" {{ $dataDetails->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn app-btn-primary">Simpan</button>
                                    <a href="/generus" class="btn app-btn-secondary">Kembali</a>
                                </div>
                            </form>
                        @else
                            <p>Loading data...</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="modal({{ $dataId }})" class="btn btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End Modal --}}

</div>



