<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class TambahAcara extends Component
{
    public $name;
    public $date;
    public $description;


    protected $rules = [
        'name' => 'required|string|max:255|min:3',
        'date' => 'required|date',
        'description' => 'required|string|max:255|min:3',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        Event::create([
            'name' => $this->name,
            'date' => $this->date,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Acara baru berhasil ditambahkan.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.tambah-acara');
    }
}
