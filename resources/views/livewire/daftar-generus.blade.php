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

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="col-auto">
                <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <div class="row gx-1 row-md gy-1">
                                <div class="col-md">
                                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Cari Generus...">
                                </div>
                                <div class="col-md">
                                    <select wire:model.live="searchKelompok" class="form-select" >
                                        <option value="">All</option>
                                        @foreach ($searchKelompoks as $kelompok)
                                            <option value="{{ $kelompok->nama }}">{{ $kelompok->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Generus</button>
                                    <a class="btn app-btn-secondary" href="/prints-generus-data">Cetak QR Code</a>
                                </div>
                            </div>
                                
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="card my-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover text-left">
                            <thead>
                                <tr>
                                    @include('livewire.includes.table-sort-th', [
                                        'name' => 'nama',
                                        'displayName' => 'Nama'
                                    ])
                                    @include('livewire.includes.table-sort-th', [
                                        'name' => 'kelas',
                                        'displayName' => 'Kelas/Status'
                                    ])
                                    @include('livewire.includes.table-sort-th', [
                                        'name' => 'kelompok_id',
                                        'displayName' => 'Kelompok'
                                    ])
                                    @include('livewire.includes.table-sort-th', [
                                        'name' => 'jenis_kelamin',
                                        'displayName' => 'Jenis Kelamin'
                                    ])
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
                                                <a href="/generus-edit/{{ $generus->id }}" class="btn btn-sm app-btn-secondary">Edit</a>
                                                <button type="button" wire:click="delete({{ $generus->id }})" class="btn btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>

                </div>
            </div>

            {{ $generuses->links('vendor.pagination.bootstrap-5') }}

            <div class="my-0">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="perPage" class="col-form-label">Per Page</label>
                    </div>
                    <div class="col-auto">
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
                        <span>Anda yakin ingin menghapus data <strong>{{ $nama }}</strong> ?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="destroy" class="btn btn-sm app-btn-primary" data-bs-dismiss="modal">Hapus</button>
                        <button type="button" class="btn btn-sm app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Info Modal --}}
    <div>
        <div wire:ignore.self class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel">Detail Generus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        @if($dataDetails)

                        <div class="row">
                            <div class="col-md-8">
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
                                        <tr>
                                            <td>Desa</td>
                                            <th>{{ $dataDetails->desa->nama }}</th>
                                        </tr>
                                        <tr>
                                            <td>Kelompok</td>
                                            <th>{{ $dataDetails->kelompok->nama }}</th>
                                        </tr>
                                    </table>
        
                                    @if ($dataDetails->guest)
                                        <h6 class="mt-4">Tempat sambung bagi yang diluar kota</h6>
                                        <table class="table mb-0 table-hover">
                                            <tr>
                                                <td>Daerah</td>
                                                <th>{{ $dataDetails->guest->daerah }}</th>
                                            </tr>
                                            <tr>
                                                <td>Desa</td>
                                                <th>{{ $dataDetails->guest->desa }}</th>
                                            </tr>
                                            <tr>
                                                <td>Kelompok</td>
                                                <th>{{ $dataDetails->guest->kelompok }}</th>
                                            </tr>
                                        </table>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                @if ($dataDetails->foto)
                                    <div class="row mb-4">
                                        <div class="col text-center">
                                            <img src="{{ asset('storage/' . $dataDetails->foto) }}" alt="Foto Generus" class="img-fluid">
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col text-center">
                                        <div>{!! $dataDetails->qr_code_image !!}</div>
                                        <span>{{ $dataDetails->qr_code }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
							
                        @else
                            <span>Loading...</span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <a class="btn app-btn-primary" href="/print-generus-data/{{ $dataId }}">
                            Cetak QR Code
                        </a>
                        <a href="/generus-edit/{{ $dataId }}" class="btn btn-sm app-btn-secondary">Edit</a>
                        <button type="button" wire:click="delete({{ $dataId }})" class="btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambah Modal --}}
    <div>
        <div wire:ignore.self class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data Generus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        @if (session()->has('created'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('created') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form wire:submit.prevent="store">
                            <div class="row">
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" wire:model.lazy="nama">
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
                                            <option value="Kuliah">Kuliah</option>
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
                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" wire:model.lazy="tempat_lahir">
                                        @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" wire:model.lazy="tanggal_lahir">
                                        @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="sekolah" class="form-label">Sekolah (opsional)</label>
                                        <input type="text" class="form-control @error('sekolah') is-invalid @enderror" id="sekolah" wire:model.lazy="sekolah">
                                        @error('sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="pekerjaan" class="form-label">Pekerjaan (opsional)</label>
                                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" wire:model.lazy="pekerjaan">
                                        @error('pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="bapak" class="form-label">Nama Bapak</label>
                                        <input type="text" class="form-control @error('bapak') is-invalid @enderror" id="bapak" wire:model.lazy="bapak">
                                        @error('bapak') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="ibu" class="form-label">Nama Ibu</label>
                                        <input type="text" class="form-control @error('ibu') is-invalid @enderror" id="ibu" wire:model.lazy="ibu">
                                        @error('ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="desa" class="form-label">Desa</label>
                                        <select class="form-select @error('desa_id') is-invalid @enderror" name="desa_id" id="desa" wire:model.live="desa_id">
                                            <option value="">Pilih Desa</option>
                                            @foreach ($desas as $desa)
                                                <option value="{{ $desa->id }}">{{ $desa->nama }}</option>
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
                                            @foreach ($kelompoks as $kelompok)
                                                <option value="{{ $kelompok->id }}">{{ $kelompok->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('kelompok_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="jenis_kelamin" class="form-label mb-3">Jenis Kelamin</label>
                                        <div class="form-check">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('jenis_kelamin') is_invalid @enderror" value="Laki-laki" type="radio" name="jenis_kelamin" id="laki-laki" wire:model.lazy="jenis_kelamin" >
                                                <label class="form-check-label" for="laki-laki">
                                                    Laki-laki
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('jenis_kelamin') is_invalid @enderror" value="Perempuan" type="radio" name="jenis_kelamin" id="perempuan" wire:model.lazy="jenis_kelamin" >
                                                <label class="form-check-label" for="perempuan">
                                                    Perempuan
                                                </label>
                                            </div>
                                            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto</label>
                                        <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" wire:model.lazy="foto">
                                        @error('foto') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <span class="text-danger">*</span> <span class="text-info">Diisi jika sedang diluar kota (tempat sambung daerah yang ditempati)</span>
                            <div class="row mt-2">
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="daerah" class="form-label"><span class="text-danger">*</span> Daerah</label>
                                        <input type="text" class="form-control @error('daerah') is-invalid @enderror" id="daerah" wire:model.lazy="daerah">
                                        @error('daerah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="mb-3">
                                        <label for="desa" class="form-label"><span class="text-danger">*</span> Desa</label>
                                        <input type="text" class="form-control @error('desa') is-invalid @enderror" id="desa" wire:model.lazy="desa">
                                        @error('desa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kelompok" class="form-label"><span class="text-danger">*</span> Kelompok</label>
                                        <input type="text" class="form-control @error('kelompok') is-invalid @enderror" id="kelompok" wire:model.lazy="kelompok">
                                        @error('kelompok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
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

    {{-- End Modal --}}

    <!-- Toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="successToast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Link berhasil disalin!
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("copyLinkButton").addEventListener("click", function() {
            var linkToCopy = document.getElementById("linkToCopy").value;
    
            navigator.clipboard.writeText(linkToCopy).then(function() {
                var toastEl = document.getElementById("successToast");
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }).catch(function(error) {
                alert("Gagal menyalin link: " + error);
            });
        });
    </script>

</div>



