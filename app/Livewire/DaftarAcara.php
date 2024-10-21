<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use App\Models\Attendance;
use Livewire\WithPagination;

class DaftarAcara extends Component
{
    use WithPagination;

    // menangkap data
    public $dataId;
    public $dataDetails;

    // update form
    public $name;
    public $date;
    public $description;

    // search
    public $search = '';

    // table
    public $sortBy = 'created_at';
    public $sortDir  = 'DESC';

    protected $rules = [
        'name' => 'required|string|max:255|min:3',
        'date' => 'required|date',
        'description' => 'nullable|string|max:255|min:3',
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

        session()->flash('created', 'Acara baru berhasil ditambahkan.');

        $this->reset();
    }

    public function setSortBy($sortByField) 
    {
        if($this->sortBy === $sortByField) {
            $this->sortDir = $this->sortDir == "ASC" ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }
    
    public $perPage = 10;

    public function updatedSearch() 
    {
        $this->resetPage();
    }

    public function delete($id) 
    {
        $this->dataId = $id;
        $this->name = Event::find($id)->name;
    }

    public function destroy()
    {
        Event::find($this->dataId)->delete();
        Attendance::where('event_id', $this->dataId)->delete();

        session()->flash('message', 'Acara berhasil dihapus.');
    }

    public function edit($id) 
    {
        $this->dataId = $id;
        $this->name = Event::find($id)->name;
        $this->date = Event::find($id)->date;
        $this->description = Event::find($id)->description;
    }

    public function update() 
    {
        $this->validate();

        Event::find($this->dataId)->update();

        session()->flash('updated', 'Acara berhasil berhasil dijadikan diubah.');
    }

    public function render()
    {
        $events = Event::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);
        
        return view('livewire.daftar-acara', [
            'events' => $events,
            'name' => $this->name
        ]);
    }
}
