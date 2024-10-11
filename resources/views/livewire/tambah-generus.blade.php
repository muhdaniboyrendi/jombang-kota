<div>
    <h2>Tambah Generus</h2>
    <div class="card">
        <div class="card-body">

            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('message') }}
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
                            <label for="sekolah" class="form-label">Sekolah <span class="text-info">(opsional)</span></label>
                            <input type="text" class="form-control @error('sekolah') is-invalid @enderror" id="sekolah" wire:model.lazy="sekolah">
                            @error('sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-info">(opsional)</span></label>
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
                    <div class="col mb-4">
                        <div class="mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                        </div>
                        @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" value="Laki-laki" type="radio" name="jenis_kelamin" id="laki-laki" wire:model.lazy="jenis_kelamin" >
                            <label class="form-check-label" for="laki-laki">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" value="Perempuan" type="radio" name="jenis_kelamin" id="perempuan" wire:model.lazy="jenis_kelamin" >
                            <label class="form-check-label" for="perempuan">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn app-btn-primary">Simpan</button>
                    <a href="/generus" class="btn app-btn-secondary">&laquo; Kembali</a>
                    <input type="text" id="linkToCopy" value="{{ url('/generus-insert') }}" hidden>
                    <a id="copyLinkButton" class="btn app-btn-secondary">Salin Link Form Tambah Generus</a>
                </div>
            </form>

        </div>
    </div>

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