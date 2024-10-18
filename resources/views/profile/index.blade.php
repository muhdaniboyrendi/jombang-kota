<x-layout-dua>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>

    <div class="app-content pt-3 p-md-3 p-lg-4">
	    <div class="container-xl">

            @if (auth()->user()->user_verified === 0)
                <div class="alert alert-warning fade show" role="alert">
                    Akun Anda belum diverifikasi. Maka dari itu anda belum bisa mengakses apapun.
                </div>
            @endif

            <h1 class="app-page-title">My Account</h1>

            <div class="row gy-4">

                <div class="col-12 col-lg-6">
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
                                    <h4 class="app-card-title">Profile</h4>
                                </div>
                            </div>
                        </div>
                        <div class="app-card-body px-4 w-100">
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Name</strong></div>
                                        <div class="item-data">{{ $profile->name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="app-card-body px-4 w-100">
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Email</strong></div>
                                        <div class="item-data">{{ $profile->email }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="app-card-body px-4 w-100">
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Role</strong></div>
                                        <div class="item-data">{{ $profile->is_admin === 1  ? 'Super Admin' : 'Admin' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="app-card-body px-4 w-100">
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Desa</strong></div>
                                        <div class="item-data">{{ $desa->nama }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="app-card-body px-4 w-100">
                            <div class="item border-bottom py-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Kelompok</strong></div>
                                        <div class="item-data">{{ $kelompok->nama }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="app-card-footer p-4 mt-auto">
                            <a class="btn app-btn-secondary" href="/profile-edit/{{ $profile->id }}">Edit Profile</a>
                            <button type="button" class="btn app-btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus Akun</button>
                        </div>
                    </div>

                </div>

            </div>

        </div>
	</div>


    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Akun</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin ingin menghapus akun anda?
                </div>
                <div class="modal-footer">
                    <form action="/account-delete/{{ auth()->user()->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn app-btn-primary">Hapus Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout-dua>