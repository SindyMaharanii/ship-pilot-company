<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Service;
use App\Models\Partnership;
use App\Models\PilotShip;
use App\Models\Contact;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    // Halaman home/beranda
    public function home()
    {
        $company = Company::first();
        $services = Service::where('is_active', true)->orderBy('order')->take(6)->get();
        $ships = PilotShip::where('is_active', true)->take(4)->get();
        $partnerships = Partnership::where('is_active', true)->take(6)->get();
        
        // ===== TAMBAHKAN INI UNTUK STATS =====
        $totalShips = PilotShip::count();
        $totalPartnerships = Partnership::count();
        
        return view('public.home', compact('company', 'services', 'ships', 'partnerships', 'totalShips', 'totalPartnerships'));
    }
    
    // Halaman tentang perusahaan
    public function about()
    {
        $company = Company::first();
        return view('public.about', compact('company'));
    }
    
    // Halaman layanan
    public function services()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        return view('public.services', compact('services'));
    }
    
    // Halaman mitra/kerja sama
    public function partnerships()
    {
        $partnerships = Partnership::where('is_active', true)->get();
        return view('public.partnerships', compact('partnerships'));
    }
    
    // Halaman daftar armada kapal
    public function fleet()
    {
        $ships = PilotShip::where('is_active', true)->get();
        return view('public.fleet', compact('ships'));
    }
    
    // Halaman detail kapal
    public function shipDetail($id)
    {
        $ship = PilotShip::findOrFail($id);
        $trackingHistory = $ship->trackingHistory()->limit(10)->get();
        
        return view('public.ship-detail', compact('ship', 'trackingHistory'));
    }
    
    // Halaman tracking/pelacakan
    public function tracking()
    {
        $ships = PilotShip::where('is_active', true)->get();
        return view('public.tracking', compact('ships'));
    }
    
    // API untuk mengambil posisi kapal (untuk map)
    public function getShipLocations()
    {
        $ships = PilotShip::where('is_active', true)
            ->select('id', 'name', 'pilot_name', 'pilot_photo', 'call_sign', 'status', 
                     'current_latitude', 'current_longitude', 'last_position_update')
            ->orderBy('name')
            ->get();
        
        $result = $ships->map(function($ship) {
            return [
                'id' => $ship->id,
                'name' => $ship->name,
                'pilot_name' => $ship->pilot_name,
                'pilot_photo' => $ship->pilot_photo ? asset('storage/' . $ship->pilot_photo) : null,
                'call_sign' => $ship->call_sign,
                'status' => $ship->status,
                'current_latitude' => $ship->current_latitude ? (float) $ship->current_latitude : null,
                'current_longitude' => $ship->current_longitude ? (float) $ship->current_longitude : null,
                'last_position_update' => $ship->last_position_update ? $ship->last_position_update->toISOString() : null,
            ];
        });
        
        return response()->json($result);
    }
    
    // Halaman kontak
    public function contact()
    {
        return view('public.contact');
    }
    
    // Proses submit form kontak
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'partnership_type' => 'nullable|string|max:255'
        ]);
        
        Contact::create($validated);
        
        return redirect()->back()->with('success', 'Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');
    }
}