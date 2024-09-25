<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>

    <div class="app-content pt-3 p-md-3 p-lg-4">
	    <div class="container-xl">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <livewire:daftar-generus />

        </div><!--//container-fluid-->
	</div><!--//app-content-->


</x-layout>