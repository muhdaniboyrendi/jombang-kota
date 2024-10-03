<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Generus;
use App\Models\Attendance;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function showAttendance(Event $event)
    {
        $attendances = $event->attendances()->with('generus')->latest()->get();
        return view('acara.kehadiran', ['title' => 'Acara | Absensi', 'active' => 'acara'], compact('event', 'attendances'));
    }

    public function recordAttendance(Request $request, Event $event)
    {
        try {
            $generus = Generus::where('qr_code', $request->qr_code)->firstOrFail();

            if (!$generus) {
                return response()->json(['error' => 'QR code tidak valid'], 400);
            }
    
            $existingAttendance = Attendance::where('event_id', $event->id)
                                            ->where('generus_id', $generus->id)
                                            ->first();
    
            if ($existingAttendance) {
                return response()->json(['error' => $generus->nama . ' sudah melakukan absensi sebelumnya.'], 400);
            }
    
            $attendance = Attendance::create([
                'event_id' => $event->id,
                'generus_id' => $generus->id,
            ]);
    
            return response()->json([
                'message' => 'Debug: Received QR code ' . $request->qr_code,
                'generus_name' => 'Debug Generus'
            ]);
            // return response()->json([
            //     'message' => 'Absensi tercatat untuk ' . $generus->nama,
            //     'generus_nama' => $generus->nama,
            // ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
