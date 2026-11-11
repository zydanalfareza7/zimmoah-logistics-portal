<?php

namespace App\Http\Controllers;

use App\Models\Advisory;
use App\Models\Office;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $advisory = Advisory::where('is_active', true)->latest('published_at')->first();
        $offices = Office::orderBy('is_headquarters', 'desc')->get();
        $schedules = Schedule::where('departure_time', '>=', now())
            ->orderBy('departure_time', 'asc')
            ->take(5)
            ->get();

        return view('home', compact('advisory', 'offices', 'schedules'));
    }

    public function tracking(Request $request)
    {
        $query = trim($request->input('tracking_number', ''));
        if (empty($query)) {
            return redirect()->route('home')->with('error', 'Silakan masukkan nomor resi, kode tiket, atau kontainer.');
        }

        // If format is like ZIM-..., redirect to ticket tracker
        if (str_starts_with(strtoupper($query), 'ZIM-')) {
            return redirect()->route('tickets.track', ['code' => strtoupper($query)]);
        }

        // Else check schedule or mock cargo tracker
        $schedule = Schedule::where('voyage_number', 'LIKE', "%{$query}%")
            ->orWhere('carrier_vessel_name', 'LIKE', "%{$query}%")
            ->first();

        return view('tracking.result', [
            'query' => $query,
            'schedule' => $schedule,
        ]);
    }
}
