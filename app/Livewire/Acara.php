<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Generus;
use Livewire\Component;
use App\Models\Attendance;

class Acara extends Component
{
    public $event;
    public $scannedCode = '';
    public $attendances;

    public function mount($eventId)
    {
        $this->event = Event::findOrFail($eventId);
        $this->loadAttendances();
    }

    public function loadAttendances()
    {
        $this->attendances = $this->event->attendances()->with('generus')->latest()->get();
    }

    public function scanQrCode()
    {
        $generus = Generus::where('qr_code', $this->scannedCode)->first();

        if ($generus) {
            $existingAttendance = Attendance::where('event_id', $this->event->id)
                                            ->where('generus_id', $generus->id)
                                            ->first();

            if ($existingAttendance) {
                session()->flash('error', $generus->nama . ' sudah melakukan absensi sebelumnya.');
            } else {
                Attendance::create([
                    'event_id' => $this->event->id,
                    'generus_id' => $generus->id,
                ]);

                session()->flash('message', 'Absensi tercatat untuk ' . $generus->nama);
                $this->loadAttendances();
            }
        } else {
            session()->flash('error', 'QR code tidak valid');
        }

        $this->scannedCode = '';
    }

    public function render()
    {
        return view('livewire.acara');
    }
}
