<x-layout>
    <x-slot:title>{{ auth()->user()->user_verified === 1 ? $title : $title = '404 - Page Not Found' }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>

    <div class="app-content pt-3 p-md-3 p-lg-4">
	    <div class="container-xl">

            @if (auth()->user()->user_verified === 1)
                <livewire:daftar-generus />
            @else
                <div class="d-flex justify-content-center align-items-center mt-4">
                    <div class="col-md-12 text-center">
                        <h1>404</h1>
                        <h2>Page Not Found</h2>
                        <p>Sorry, the page you are looking for does not exist.</p>
                        <h5><a href="/profile/{{ auth()->id() }}">&laquo; Click here to back to the main page</a></h5>
                    </div>
                </div>
            @endif

        </div>
	</div>

</x-layout>