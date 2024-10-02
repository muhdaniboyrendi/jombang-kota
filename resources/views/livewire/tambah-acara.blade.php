<div>
    <h2>Tambah Acara</h2>
    <div class="card">
        <div class="card-body">

            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form wire:submit.prevent="store">
                <div class="mb-3">
                    <label for="name" class="form-label">Name Acara</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.lazy="name">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal Acara</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" wire:model.lazy="date">
                    @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Acara</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model.lazy="description" rows="3"></textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn app-btn-primary">Simpan</button>
                    <a href="/ms" class="btn app-btn-secondary">Kembali</a>
                </div>
            </form>

        </div>
    </div>
</div>