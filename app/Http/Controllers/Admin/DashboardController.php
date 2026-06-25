<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PilotShip;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Partnership;
use App\Models\Company;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ===== STATISTIK =====
        $totalShips = PilotShip::count();
        $activeShips = PilotShip::where('status', 'available')->count();
        $onDutyShips = PilotShip::where('status', 'on_duty')->count();
        $maintenanceShips = PilotShip::where('status', 'maintenance')->count();
        $pendingContacts = Contact::where('status', 'pending')->count();
        $totalServices = Service::count();
        $totalPartnerships = Partnership::count();

        // ===== DATA UNTUK TAMPILAN =====
        // Ambil data company
        $company = Company::first();

        // Ambil data services (SAMA dengan public/home)
        $services = Service::where('is_active', true)
                    ->orderBy('order', 'asc')
                    ->take(6)
                    ->get();

        // Ambil data ships (SAMA dengan public/home)
        $ships = PilotShip::where('is_active', true)
                ->take(4)
                ->get();

        // Ambil data partnerships (SAMA dengan public/home)
        $partnerships = Partnership::where('is_active', true)
                        ->take(6)
                        ->get();

        // Data tambahan
        $recentContacts = Contact::latest()->limit(5)->get();
        $recentShips = PilotShip::latest()->limit(5)->get();

        // ===== KIRIM KE VIEW =====
        return view('admin.dashboard', compact(
            'totalShips',
            'activeShips',
            'onDutyShips',
            'maintenanceShips',
            'pendingContacts',
            'totalServices',
            'totalPartnerships',
            'company',
            'services',
            'ships',
            'partnerships',
            'recentContacts',
            'recentShips'
        ));
    }
}