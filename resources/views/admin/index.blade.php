<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>

    <div class="app-content pt-3 p-md-3 p-lg-4">
	    <div class="container-xl">

            @if (auth()->user()->is_admin === 1)
                <livewire:daftar-admin />
            @else
                <h1 class="text-center">404 - Page Not Found</h1>
            @endif

        </div>
	</div>

</x-layout>