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
            'pilot_name' => 'nullable|string|max:255',
            'call_sign' => 'required|string|unique:pilot_ships',
            'registration_number' => 'nullable|string',
            'type' => 'nullable|string',
            'status' => 'required|in:available,on_duty,maintenance,offline',
            'technical_specs' => 'nullable|string',
            'capacity' => 'nullable|integer',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'draft' => 'nullable|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'pilot_photo' => 'nullable|image|max:2048',
            'tracking_url' => 'nullable|string|max:255',
            'tracking_provider' => 'nullable|string|max:50',
            'tracking_identifier' => 'nullable|string|max:50'
        ]);
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('ships', 'public');
            $validated['photo'] = $path;
        }
        
        if ($request->hasFile('pilot_photo')) {
            $path = $request->file('pilot_photo')->store('pilots', 'public');
            $validated['pilot_photo'] = $path;
        }
        
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
            'pilot_name' => 'nullable|string|max:255',
            'call_sign' => 'required|string|unique:pilot_ships,call_sign,' . $id,
            'registration_number' => 'nullable|string',
            'type' => 'nullable|string',
            'status' => 'required|in:available,on_duty,maintenance,offline',
            'technical_specs' => 'nullable|string',
            'capacity' => 'nullable|integer',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'draft' => 'nullable|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'pilot_photo' => 'nullable|image|max:2048',
            'tracking_url' => 'nullable|string|max:255',
            'tracking_provider' => 'nullable|string|max:50',
            'tracking_identifier' => 'nullable|string|max:50'
        ]);
        
        // Upload foto kapal
        if ($request->hasFile('photo')) {
            if ($ship->photo && Storage::disk('public')->exists($ship->photo)) {
                Storage::disk('public')->delete($ship->photo);
            }
            $path = $request->file('photo')->store('ships', 'public');
            $validated['photo'] = $path;
        }
        
        // Upload foto pandu
        if ($request->hasFile('pilot_photo')) {
            if ($ship->pilot_photo && Storage::disk('public')->exists($ship->pilot_photo)) {
                Storage::disk('public')->delete($ship->pilot_photo);
            }
            $path = $request->file('pilot_photo')->store('pilots', 'public');
            $validated['pilot_photo'] = $path;
        }
        
        $ship->update($validated);
        
        return redirect()->route('admin.ships.index')->with('success', 'Data kapal pandu berhasil diperbarui!');
    }
    
    // Hapus kapal
    public function destroy($id)
    {
        $ship = PilotShip::findOrFail($id);
        
        if ($ship->photo && Storage::disk('public')->exists($ship->photo)) {
            Storage::disk('public')->delete($ship->photo);
        }
        
        $ship->delete();
        
        return redirect()->route('admin.ships.index')->with('success', 'Kapal pandu berhasil dihapus.');
    }
}