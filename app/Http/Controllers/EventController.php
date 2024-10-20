<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Generus;
use App\Models\Attendance;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        return view('acara.index', ['title' => 'Acara', 'active' => 'acara']);
    }

    public function showAttendance(Event $event)
    {
        $attendances = $event->attendances()
        ->with(['generus' => function($query) {
            $query->with('kelompok');
        }])->latest()->get();

        $totalAttendances = $attendances->count();

        $attendancesByGroup = $attendances->groupBy('generus.kelompok.nama')
            ->map(function ($group) {
                return [
                    'total' => $group->count(),
                    'laki-laki' => $group->where('generus.jenis_kelamin', 'Laki-laki')->count(),
                    'perempuan' => $group->where('generus.jenis_kelamin', 'Perempuan')->count(),
                ];
            });

        $totalGroupsPresent = $attendancesByGroup->count();
        
        $attendancesByGender = $attendances->groupBy('generus.jenis_kelamin')
            ->map(function ($group) {
                return $group->count();
            });

        return view('acara.kehadiran', [
            'title' => 'Acara', 
            'active' => 'acara',
            'totalAttendances' => $totalAttendances,
            'attendancesByGroup' => $attendancesByGroup,
            'attendancesByGender' => $attendancesByGender,
            'totalGroupsPresent' => $totalGroupsPresent,
        ], compact('event', 'attendances'));
    }

    public function recordAttendance(Request $request, Event $event)
    {
        $generus = Generus::where('qr_code', $request->qr_code)->first();

        if (!$generus) {
            return response()->json(['error' => 'QR code tidak valid'], 400);
        }

        $existingAttendance = Attendance::where('event_id', $event->id)
                                        ->where('generus_id', $generus->id)
                                        ->first();

        if ($existingAttendance) {
            return response()->json(['error' => $generus->nama . ' sudah melakukan absensi sebelumnya.'], 400);
        }

        $attendance = new Attendance();
        $attendance->event_id = $event->id;
        $attendance->generus_id = $generus->id;
        $attendance->attended_at = now();
        $attendance->save();

        $updatedStats = $this->calculateAttendanceStatistics($event);

        return response()->json([
            'message' => 'Kehadiran berhasil dicatat',
            'generus_nama' => $generus->nama,
            'generus_kelompok' => $generus->kelompok->nama ?? 'Tidak ada kelompok',
            'generus_jenis_kelamin' => $generus->jenis_kelamin,
            'attendance_time' => $attendance->attended_at->format('Y-m-d H:i:s'),
            'totalAttendances' => $updatedStats['totalAttendances'],
            'totalGroupsPresent' => $updatedStats['totalGroupsPresent'],
            'attendancesByGender' => $updatedStats['attendancesByGender'],
            'attendancesByGroup' => $updatedStats['attendancesByGroup'],
        ]);
    }

    private function calculateAttendanceStatistics(Event $event)
    {
        $attendances = $event->attendances()->with(['generus' => function($query) {
            $query->with('kelompok');
        }])->get();

        $totalAttendances = $attendances->count();

        $attendancesByGroup = $attendances->groupBy('generus.kelompok.nama')
            ->map(function ($group) {
                return [
                    'total' => $group->count(),
                    'laki-laki' => $group->where('generus.jenis_kelamin', 'Laki-laki')->count(),
                    'perempuan' => $group->where('generus.jenis_kelamin', 'Perempuan')->count(),
                ];
            });

        $attendancesByGender = $attendances->groupBy('generus.jenis_kelamin')
            ->map(function ($group) {
                return $group->count();
            })->toArray();

        $attendancesByGender = array_merge([
            'laki-laki' => 0,
            'perempuan' => 0
        ], $attendancesByGender);

        $totalGroupsPresent = $attendancesByGroup->count();

        return [
            'totalAttendances' => $totalAttendances,
            'totalGroupsPresent' => $totalGroupsPresent,
            'attendancesByGender' => $attendancesByGender,
            'attendancesByGroup' => $attendancesByGroup,
        ];
    }
}
