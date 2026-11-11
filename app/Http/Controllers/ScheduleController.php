<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    public function index(Request $request): View
    {
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $mode = $request->input('mode');

        $query = Schedule::query();

        if ($origin) {
            $query->where('origin_port', 'LIKE', "%{$origin}%");
        }
        if ($destination) {
            $query->where('destination_port', 'LIKE', "%{$destination}%");
        }
        if ($mode && in_array(strtoupper($mode), ['SEA', 'AIR', 'ROAD'])) {
            $query->where('transport_mode', strtoupper($mode));
        }

        $schedules = $query->orderBy('departure_time', 'asc')->paginate(10);

        return view('schedules.index', compact('schedules', 'origin', 'destination', 'mode'));
    }
}
