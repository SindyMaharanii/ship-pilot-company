<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Service;
use App\Models\Partnership;
use App\Models\PilotShip;
use App\Models\Contact;
use App\Models\ContactInfo;
use App\Services\VesselFinderService;
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
    
public function shipDetail($id)
{
    $ship = PilotShip::findOrFail($id);
    return view('public.ship-detail', compact('ship')); // HAPUS 'trackingHistory' dari compact
}
    
    // API untuk mengambil posisi kapal (untuk map) - DENGAN VESSELFINDER
  public function getShipLocations()
{
    $ships = PilotShip::where('is_active', true)->get();
    $vesselService = new \App\Services\VesselFinderService();
    
    $result = $ships->map(function($ship) use ($vesselService) {
        $data = [
            'id' => $ship->id,
            'name' => $ship->name,
            'pilot_name' => $ship->pilot_name,
            'pilot_photo' => $ship->pilot_photo ? asset('storage/' . $ship->pilot_photo) : null,
            'call_sign' => $ship->call_sign,
            'mmsi' => $ship->mmsi,
            'type' => $ship->type,
            'length' => $ship->length,
            'width' => $ship->width,
            'status' => $ship->status,
            'current_latitude' => null,
            'current_longitude' => null,
            'last_position_update' => null,
        ];
        
        // Ambil dari VesselFinder jika ada MMSI
        if ($ship->mmsi) {
            $vesselData = $vesselService->getVessel($ship->mmsi);
            
            if ($vesselData) {
                // Cek berbagai format response
                $vessel = null;
                if (isset($vesselData['data'])) {
                    $vessel = $vesselData['data'];
                } elseif (isset($vesselData['vessel'])) {
                    $vessel = $vesselData['vessel'];
                } elseif (isset($vesselData[0])) {
                    $vessel = $vesselData[0];
                } else {
                    $vessel = $vesselData;
                }
                
                if ($vessel) {
                    // Ambil posisi
                    if (isset($vessel['lat']) && isset($vessel['lon'])) {
                        $data['current_latitude'] = (float) $vessel['lat'];
                        $data['current_longitude'] = (float) $vessel['lon'];
                        $data['last_position_update'] = $vessel['last_update'] ?? now()->toISOString();
                    }
                    
                    // Ambil status
                    if (isset($vessel['status'])) {
                        $data['status'] = $vessel['status'];
                    }
                    
                    // Simpan semua data vessel
                    $data['vessel_info'] = $vessel;
                }
            }
        }
        
        // Fallback: jika tidak ada data dari VesselFinder, pakai data database
        if ($data['current_latitude'] === null) {
            $data['current_latitude'] = $ship->current_latitude ? (float) $ship->current_latitude : null;
            $data['current_longitude'] = $ship->current_longitude ? (float) $ship->current_longitude : null;
            $data['last_position_update'] = $ship->last_position_update ? $ship->last_position_update->toISOString() : null;
        }
        
        return $data;
    });
    
    return response()->json($result);
}

    public function contact()
    {
        $contact = ContactInfo::first();
        return view('public.contact', compact('contact'));
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