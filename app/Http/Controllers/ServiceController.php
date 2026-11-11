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
        return view('services.trucking', compact('offices'));
    }

    public function consolidation(): View
    {
        $offices = Office::all();
        return view('services.consolidation', compact('offices'));
    }

    public function profile(): View
    {
        $offices = Office::all();
        return view('company.profile', compact('offices'));
    }

    public function contact(): View
    {
        $offices = Office::all();
        return view('company.contact', compact('offices'));
    }
}
