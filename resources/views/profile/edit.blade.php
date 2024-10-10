<x-layout-dua>
    <x-slot:title>{{ $title }}</x-slot>
    <x-slot:active>{{ $active }}</x-slot>

    <div class="app-content pt-3 p-md-3 p-lg-4">
	    <div class="container-xl">

            <livewire:edit-profile :userId="$userId" />

        </div>
	</div>

</x-layout-dua>