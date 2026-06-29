<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnershipController extends Controller
{
    public function index()
    {
        $partnerships = Partnership::all();
        return view('admin.partnerships.index', compact('partnerships'));
    }

    public function create()
    {
        return view('admin.partnerships.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'partner_name' => 'required|string|max:255',
            'description' => 'required|string',
            'collaboration_experience' => 'nullable|string',
            'partnership_opportunity' => 'nullable|string',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('partnerships', 'public');
            $validated['logo'] = $path;
        }

        // ===== PERBAIKI: is_active =====
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        Partnership::create($validated);

        return redirect()->route('admin.partnerships.index')
            ->with('success', '✅ Mitra "' . $validated['partner_name'] . '" berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $partner = Partnership::findOrFail($id);
        return view('admin.partnerships.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = Partnership::findOrFail($id);

        $validated = $request->validate([
            'partner_name' => 'required|string|max:255',
            'description' => 'required|string',
            'collaboration_experience' => 'nullable|string',
            'partnership_opportunity' => 'nullable|string',
            'website' => 'nullable|url',
            'logo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }
            $path = $request->file('logo')->store('partnerships', 'public');
            $validated['logo'] = $path;
        }

        // ===== PERBAIKI: is_active =====
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $partner->update($validated);

        return redirect()->route('admin.partnerships.index')
            ->with('success', '✅ Mitra "' . $validated['partner_name'] . '" berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $partner = Partnership::findOrFail($id);
        $name = $partner->partner_name;
        
        if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
            Storage::disk('public')->delete($partner->logo);
        }
        $partner->delete();

        return redirect()->route('admin.partnerships.index')
            ->with('success', '✅ Mitra "' . $name . '" berhasil dihapus!');
    }
}