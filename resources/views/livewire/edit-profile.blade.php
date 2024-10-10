<div>
    <h1 class="app-page-title">My Account</h1>

            <div class="row gy-4">

                <div class="col-12">

                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4 class="app-card-title">Edit Profile</h4>
                                </div>
                            </div>
                        </div>

                        @if (session()->has('message'))
                            <div class="app-card-body px-4 w-100">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        <div class="app-card-body px-4 w-100">

                            <form wire:submit.prevent="update">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.lazy="name" required>
                                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.lazy="email" required>
                                            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="desa_id" class="form-label">Desa</label>
                                            <select class="form-select @error('desa_id') is-invalid @enderror" id="desa_id" wire:model.live="desa_id" required>
                                                <option value="">Pilih Desa</option>
                                                @foreach($desas as $desa)
                                                    <option value="{{ $desa->id }}">{{ $desa->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('desa_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="kelompok_id" class="form-label">Kelompok</label>
                                            <select class="form-select @error('kelompok_id') is-invalid @enderror" id="kelompok_id" wire:model.live="kelompok_id" required>
                                                <option value="">Pilih Kelompok</option>
                                                @foreach($kelompoks as $kelompok)
                                                    <option value="{{ $kelompok->id }}">{{ $kelompok->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('kelompok_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="text-info">(Biarkan kosong jika tidak ingin mengubah)</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-3">
                                            <label for="password" class="form-label">Password Baru</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model.lazy="password">
                                            @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mt-3">
                                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" wire:model.lazy="password_confirmation">
                                            @error('password_confirmation') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>


                        
                                <div class="d-grid gap-2 my-4">
                                    <button class="btn app-btn-primary" type="submit">Update</button>
                                    <a class="btn app-btn-secondary" href="/profile/{{ auth()->user()->id }}">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
</div>
