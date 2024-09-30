<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <div class="container">
                    <div class="card-body">
                        <h2 class="text-center mt-2">Login</h2>

                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form wire:submit.prevent="login">
                            <div class="my-3">
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
