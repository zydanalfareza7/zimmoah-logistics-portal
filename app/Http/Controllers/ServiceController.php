<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function forwarding(): View
    {
        $offices = Office::all();

        return view('services.forwarding', compact('offices'));
    }

    public function warehousing(): View
    {
        $offices = Office::all();

        return view('services.warehousing', compact('offices'));
    }

    public function trucking(): View
    {
        $offices = Office::all();
        $fleet = config('zimmoah.fleet', []);
        $truckingRoutes = config('zimmoah.trucking_routes', []);

        return view('services.trucking', compact('offices', 'fleet', 'truckingRoutes'));
    }

    public function consolidation(): View
    {
        $offices = Office::all();

        return view('services.consolidation', compact('offices'));
    }

    public function profile(): View
    {
        $offices = Office::all();
        $profilePdf = config('zimmoah.documents.company_profile_pdf');

        return view('company.profile', compact('offices', 'profilePdf'));
    }

    public function ceoMessage(): View
    {
        return view('company.ceo');
    }

    public function history(): View
    {
        $timeline = config('zimmoah.history', []);

        return view('company.history', compact('timeline'));
    }

    public function cip(): View
    {
        $downloads = config('zimmoah.cip_downloads', []);

        return view('company.cip', compact('downloads'));
    }

    public function license(): View
    {
        return view('company.license');
    }

    public function organization(): View
    {
        return view('company.organization');
    }

    public function branches(): View
    {
        $branches = config('zimmoah.branches', []);

        return view('company.branches', compact('branches'));
    }

    public function contact(): View
    {
        $offices = Office::all();
        $directory = config('zimmoah.directory', []);
        $branches = config('zimmoah.branches', []);

        return view('company.contact', compact('offices', 'directory', 'branches'));
    }
}
