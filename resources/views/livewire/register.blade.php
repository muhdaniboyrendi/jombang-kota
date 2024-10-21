<div class="row justify-content-center align-items-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

                <h2 class="text-center">Register</h2>
            
                @if (session()->has('message'))
                    <div class="alert alert-success fade show">
                        {{ session('message') }}
                    </div>
                @endif
            
                <form wire:submit.prevent="store">
                    <div class="row mt-4">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.lazy="name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>    
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.lazy="email">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model="password">
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" wire:model="password_confirmation">
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
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>
                    <div class="my-3 text-center">
                        <span>Already have an account?<a href="/login"> Login</a></span>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>