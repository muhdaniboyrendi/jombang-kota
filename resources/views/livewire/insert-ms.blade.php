<div>
    <div class="card">
        <div class="card-body">

            @if (session()->has('message'))

                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Terima Kasih!</h4>
                    <p>
                        Data yang anda masukan sudah kami terima dan akan kami cek kevalidan data anda
                    </p>
                    <hr>
                    <a href="/generus-insert" class="mb-0">
                        Kirim masukan lain
                    </a>
                </div>

            @else

                <h2 class="text-center mb-4">Form Data Mubaligh Setempat Daerah Jombang Kota</h2>

                <hr class="mb-4">

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
                                <label for="no_hp" class="form-label">Nomor HP</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" wire:model.lazy="no_hp">
                                @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                    <div class="row mb-4">
                        <div class="col-md">
                            <div class="mb-3">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" value="Laki-laki" type="radio" name="jenis_kelamin" id="laki-laki" wire:model.lazy="jenis_kelamin">
                                <label class="form-check-label" for="laki-laki">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" value="Perempuan" type="radio" name="jenis_kelamin" id="perempuan" wire:model.lazy="jenis_kelamin">
                                <label class="form-check-label" for="perempuan">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            @endif

        </div>
    </div>

</div>