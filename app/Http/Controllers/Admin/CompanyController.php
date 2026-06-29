<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    // ===== INDEX =====
    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index', compact('companies'));
    }

    // ===== CREATE =====
    public function create()
    {
        return view('admin.company.create');
    }

    // ===== STORE =====
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'history' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'description' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'logo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $path;
        }

        Company::create($validated);

        return redirect()->route('admin.company.index')
            ->with('success', '✅ Profil perusahaan "' . $validated['name'] . '" berhasil ditambahkan!');
    }

    // ===== EDIT =====
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.company.edit', compact('company'));
    }

    // ===== UPDATE =====
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'history' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'description' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'logo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $path;
        }

        $company->update($validated);

        return redirect()->route('admin.company.index')
            ->with('success', '✅ Profil perusahaan "' . $validated['name'] . '" berhasil diperbarui!');
    }

    // ===== DESTROY =====
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $name = $company->name;

        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }
        $company->delete();

        return redirect()->route('admin.company.index')
            ->with('success', '✅ Profil perusahaan "' . $name . '" berhasil dihapus!');
    }
}