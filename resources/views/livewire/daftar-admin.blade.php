<div>
    <h2>Users</h2>
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
                                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Cari Admin...">
                                </div>
                                <div class="col-md">
                                    <select wire:model.live="kelompok" class="form-select" >
                                        <option value="">All</option>
                                        @foreach ($kelompoks as $kelompok)
                                            <option value="{{ $kelompok->nama }}">{{ $kelompok->nama }}</option>
                                        @endforeach
                                    </select>
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
                                        'name' => 'name',
                                        'displayName' => 'Nama'
                                    ])
                                    @include('livewire.includes.table-sort-th', [
                                        'name' => 'kelompok_id',
                                        'displayName' => 'Kelompok'
                                    ])
                                    @include('livewire.includes.table-sort-th', [
                                        'name' => 'is_admin',
                                        'displayName' => 'Role'
                                    ])
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr wire:key="{{ $user->id }}">
                                        <td class="align-middle">{{ $user->name }}</td>
                                        <td class="align-middle">{{ $user->kelompok->nama }}</td>
                                        <td class="align-middle">
                                            @if ($user->user_verified === 0)
                                                User
                                            @else
                                                {{ $user->is_admin == 1 ? 'Super Admin' : 'Admin' }}</td>
                                            @endif
                                        <td class="align-middle">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" wire:click="modal({{ $user->id }})" class="btn btn-sm app-btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal">Info</button>
                                                @if ($user->user_verified === 0)
                                                    <button type="button" wire:click="verify({{ $user->id }})" class="btn btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#verifyModal">Verify User</button>
                                                    <button type="button" wire:click="delete({{ $user->id }})" class="btn btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                                @else
                                                    @if ($user->is_admin == 0)
                                                        <button type="button" wire:click="edit({{ $user->id }})" class="btn btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#setSuperAdminModal">Set Super Admin</button>
                                                        <button type="button" wire:click="delete({{ $user->id }})" class="btn btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            {{ $users->links('vendor.pagination.bootstrap-5') }}

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
    {{-- Info Modal --}}
    <div>
        <div wire:ignore.self class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel">Detail Data Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if($dataDetails)
							<div class="table-responsive">
								<table class="table mb-0 table-hover">
                                    <tr>
                                        <td>Nama</td>
                                        <th>{{ $dataDetails->name }}</th>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <th>{{ $dataDetails->email }}</th>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <th>
                                            @if ($dataDetails->user_verified === 0)
                                                User
                                            @else
                                                {{ $dataDetails->is_admin == 1 ? 'Super Admin' : 'Admin' }}</th>
                                            @endif
                                    </tr>
                                        <td>Desa</td>
                                        <th>{{ $dataDetails->desa->nama }}</th>
                                    </tr>
                                    <tr>
                                        <td>Kelompok</td>
                                        <th>{{ $dataDetails->kelompok->nama }}</th>
                                    </tr>
								</table>
							</div>
                        @else
                            <span>Loading...</span>
                        @endif
                    </div>
                    @if ($dataDetails)
                        @if ($dataDetails->user_verified === 0)
                            <div class="modal-footer">
                                <button type="button" wire:click="verify({{ $dataId }})" class="btn btn-sm app-btn-primary" data-bs-toggle="modal" data-bs-target="#verifyModal">Verify User</button>
                                <button type="button" wire:click="delete({{ $dataId }})" class="btn btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                            </div>
                        @else
                            @if ($dataDetails->is_admin === 0)
                                <div class="modal-footer">
                                    <button type="button" wire:click="edit({{ $dataId }})" class="btn btn-sm app-btn-primary" data-bs-toggle="modal" data-bs-target="#setSuperAdminModal">Set Super Admin</button>
                                    <button type="button" wire:click="delete({{ $dataId }})" class="btn btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                </div>
                            @endif
                        @endif
                    @endif
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
                        <h5 class="modal-title" id="deleteModalLabel">Hapus User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span>Anda yakin ingin menghapus <strong>{{ $name }}</strong>?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="destroy" class="btn btn-sm app-btn-primary" data-bs-dismiss="modal">Delete</button>
                        <button type="button" class="btn btn-sm app-btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Verify User Modal --}}
    <div>
        <div wire:ignore.self class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verifyModalLabel">Verify User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        @if (session()->has('verified'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('verified') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form wire:submit.prevent="verified">
                            <span>Anda yakin untuk memverifikasi <strong>{{ $name }}</strong>?</span>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="user_verified" checked disabled>
                                <label class="form-check-label" for="user_verified">
                                    Verify
                                </label>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn app-btn-primary">Yes</button>
                                <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">No</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Set Super Admin Modal --}}
    <div>
        <div wire:ignore.self class="modal fade" id="setSuperAdminModal" tabindex="-1" aria-labelledby="setSuperAdminModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="setSuperAdminModalLabel">Super Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        @if (session()->has('updated'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('updated') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form wire:submit.prevent="update">
                            <span>Anda yakin ingin menjadikan <strong>{{ $name }}</strong> sebagai Super Admin?</span>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="is_admin" checked disabled>
                                <label class="form-check-label" for="is_admin">
                                    Super Admin
                                </label>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn app-btn-primary">Yes</button>
                                <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">No</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End Modal --}}

</div>



