<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PilotShip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShipController extends Controller
{
    // Menampilkan daftar kapal
    public function index()
    {
        $ships = PilotShip::latest()->paginate(10);
        return view('admin.ships.index', compact('ships'));
    }
    
    // Form tambah kapal
    public function create()
    {
        return view('admin.ships.create');
    }
    
    // Menyimpan kapal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'call_sign' => 'required|string|unique:pilot_ships',
            'registration_number' => 'nullable|string',
            'type' => 'nullable|string',
            'status' => 'required|in:available,on_duty,maintenance,offline',
            'technical_specs' => 'nullable|string',
            'capacity' => 'nullable|integer',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'draft' => 'nullable|numeric',
            'speed' => 'nullable|numeric',
            'current_latitude' => 'nullable|numeric',
            'current_longitude' => 'nullable|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'pilot_photo' => 'nullable|image|max:2048'
        ]);
        
        // Set last position update jika ada koordinat
        if (!empty($validated['current_latitude']) && !empty($validated['current_longitude'])) {
            $validated['last_position_update'] = now();
        }
        
        // Upload foto
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('ships', 'public');
            $validated['photo'] = $path;
        }
        
        if ($request->hasFile('pilot_photo')) {
        $path = $request->file('pilot_photo')->store('pilots', 'public');
        $validated['pilot_photo'] = $path;
    }

        // Set default is_active
        $validated['is_active'] = true;
        
        PilotShip::create($validated);
        
        return redirect()->route('admin.ships.index')->with('success', 'Kapal pandu berhasil ditambahkan.');
    }
    
    // Form edit kapal
    public function edit($id)
    {
        $ship = PilotShip::findOrFail($id);
        return view('admin.ships.edit', compact('ship'));
    }
    
    // Update data kapal
    public function update(Request $request, $id)
    {
        $ship = PilotShip::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'call_sign' => 'required|string|unique:pilot_ships,call_sign,' . $id,
            'registration_number' => 'nullable|string',
            'type' => 'nullable|string',
            'status' => 'required|in:available,on_duty,maintenance,offline',
            'technical_specs' => 'nullable|string',
            'capacity' => 'nullable|integer',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'draft' => 'nullable|numeric',
            'speed' => 'nullable|numeric',
            'current_latitude' => 'nullable|numeric',
            'current_longitude' => 'nullable|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'pilot_photo' => 'nullable|image|max:2048'
        ]);
        
        // Upload foto kapal baru jika ada
    if ($request->hasFile('photo')) {
        if ($ship->photo && Storage::disk('public')->exists($ship->photo)) {
            Storage::disk('public')->delete($ship->photo);
        }
        $path = $request->file('photo')->store('ships', 'public');
        $validated['photo'] = $path;
    }

    // Upload foto pandu baru jika ada
    if ($request->hasFile('pilot_photo')) {
        if ($ship->pilot_photo && Storage::disk('public')->exists($ship->pilot_photo)) {
            Storage::disk('public')->delete($ship->pilot_photo);
        }
        $path = $request->file('pilot_photo')->store('pilots', 'public');
        $validated['pilot_photo'] = $path;
    }
    
    $ship->update($validated);
    
    return redirect()->route('admin.ships.index')->with('success', 'Data kapal pandu berhasil diperbarui.');

        // Update last position update jika koordinat berubah
        if (!empty($validated['current_latitude']) && !empty($validated['current_longitude'])) {
            if ($ship->current_latitude != $validated['current_latitude'] || 
                $ship->current_longitude != $validated['current_longitude']) {
                $validated['last_position_update'] = now();
                
                // Hitung kecepatan otomatis jika ada posisi sebelumnya
                if ($ship->current_latitude && $ship->current_longitude && $ship->last_position_update) {
                    $kecepatan = PilotShip::hitungKecepatan(
                        $ship->current_latitude, $ship->current_longitude, $ship->last_position_update,
                        $validated['current_latitude'], $validated['current_longitude'], now()
                    );
                    if ($kecepatan > 0) {
                        $validated['speed'] = $kecepatan;
                    }
                }
            }
        }
        
        // Upload foto baru jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($ship->photo && Storage::disk('public')->exists($ship->photo)) {
                Storage::disk('public')->delete($ship->photo);
            }
            $path = $request->file('photo')->store('ships', 'public');
            $validated['photo'] = $path;
        }
        
        $ship->update($validated);
        
        return redirect()->route('admin.ships.index')->with('success', 'Data kapal pandu berhasil diperbarui.');
    }
    
    // Update posisi kapal (via AJAX) - DENGAN HITUNG KECEPATAN OTOMATIS
    public function updatePosition(Request $request, $id)
    {
        $ship = PilotShip::findOrFail($id);
        
        $validated = $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'status' => 'nullable|in:available,on_duty,maintenance,offline'
        ]);
        
        $kecepatan = $ship->updatePosition(
            $validated['latitude'], 
            $validated['longitude'], 
            $validated['status'] ?? null
        );
        
        $message = 'Posisi kapal diperbarui.';
        if ($kecepatan !== null && $kecepatan > 0) {
            $message .= ' Kecepatan: ' . $kecepatan . ' km/jam';
        }
        
        return response()->json(['success' => true, 'message' => $message, 'speed' => $kecepatan]);
    }
    
    // Riwayat pelacakan kapal
    public function history($id)
    {
        $ship = PilotShip::findOrFail($id);
        $history = $ship->trackingHistory()->paginate(20);
        return view('admin.ships.history', compact('ship', 'history'));
    }
    
    // Update status kapal (via AJAX)
    public function updateStatus(Request $request, $id)
    {
        $ship = PilotShip::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:available,on_duty,maintenance,offline'
        ]);
        
        $ship->status = $validated['status'];
        $ship->save();
        
        return response()->json(['success' => true]);
    }
    
    // Hapus kapal
    public function destroy($id)
    {
        $ship = PilotShip::findOrFail($id);
        
        // Hapus foto jika ada
        if ($ship->photo && Storage::disk('public')->exists($ship->photo)) {
            Storage::disk('public')->delete($ship->photo);
        }
        
        $ship->delete();
        
        return redirect()->route('admin.ships.index')->with('success', 'Kapal pandu berhasil dihapus.');
    }
}