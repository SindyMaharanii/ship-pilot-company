<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'procedure' => 'nullable|string',
            'advantages' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $validated['image'] = $path;
        }

        // ===== PERBAIKI: is_active =====
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['order'] = $request->order ?? 0;

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', '✅ Layanan "' . $validated['name'] . '" berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'procedure' => 'nullable|string',
            'advantages' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $path = $request->file('image')->store('services', 'public');
            $validated['image'] = $path;
        }

        // ===== PERBAIKI: is_active =====
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['order'] = $request->order ?? 0;

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', '✅ Layanan "' . $validated['name'] . '" berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $name = $service->name;
        
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', '✅ Layanan "' . $name . '" berhasil dihapus!');
    }
}