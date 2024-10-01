<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class DaftarAcara extends Component
{
    public function render()
    {
        $events = Event::orderBy('date', 'desc')->get();
        
        return view('livewire.daftar-acara', ['events' => $events]);
    }
}
