<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocaleMiddleware;
use App\Models\Advisory;
use App\Models\Office;
use App\Models\Schedule;
use App\Models\Shipment;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function switchLocale(string $locale): RedirectResponse
    {
        if (! in_array($locale, SetLocaleMiddleware::SUPPORTED_LOCALES, true)) {
            $locale = 'id';
        }

        session(['locale' => $locale]);
        App::setLocale($locale);

        return redirect()->back()->with('success', __('messages.locale_switched'));
    }

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

    public function tracking(Request $request): View|RedirectResponse
    {
        $query = trim((string) $request->input('tracking_number', ''));
        $sampleShipments = Shipment::select('tracking_number', 'origin_port', 'destination_port', 'current_stage', 'transport_mode')
            ->latest()
            ->take(4)
            ->get();

        if ($query === '') {
            return view('tracking.result', [
                'query' => '',
                'shipment' => null,
                'schedule' => null,
                'sampleShipments' => $sampleShipments,
            ]);
        }

        $normalized = strtoupper($query);

        // 1. Check Shipments table first (Tracking Number or Container/AWB)
        $shipment = Shipment::whereRaw('UPPER(tracking_number) = ?', [$normalized])
            ->orWhereRaw('UPPER(container_or_awb) = ?', [$normalized])
            ->first();

        if ($shipment) {
            return view('tracking.result', [
                'query' => $query,
                'shipment' => $shipment,
                'schedule' => null,
                'sampleShipments' => $sampleShipments,
            ]);
        }

        // 2. Check if it matches an existing Ticket or ZIM-YYYY- ticket pattern
        $ticketExists = Ticket::whereRaw('UPPER(ticket_code) = ?', [$normalized])->exists();
        if ($ticketExists || preg_match('/^ZIM-\d{4}-/', $normalized)) {
            return redirect()->route('tickets.track', ['code' => $normalized]);
        }

        // 3. Fallback: Check Schedule (voyage number or vessel name)
        $schedule = Schedule::where('voyage_number', 'LIKE', "%{$query}%")
            ->orWhere('carrier_vessel_name', 'LIKE', "%{$query}%")
            ->first();

        return view('tracking.result', [
            'query' => $query,
            'shipment' => null,
            'schedule' => $schedule,
            'sampleShipments' => $sampleShipments,
        ]);
    }
}
