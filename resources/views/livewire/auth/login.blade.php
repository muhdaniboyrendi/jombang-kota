<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="container">
                    <h2 class="text-center my-3">Login</h2>
                    <div class="card-body">

                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="login">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" wire:model="email" class="form-control" id="email" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" wire:model="password" class="form-control" id="password" required>
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4 text-center">
                                <a href="">Forgot your password?</a>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-success" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
