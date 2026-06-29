<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        $contact = ContactInfo::first();
        return view('admin.contact.index', compact('contact'));
    }

    public function update(Request $request)
    {
        $contact = ContactInfo::first();

        $validated = $request->validate([
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'description' => 'nullable|string',
            'map_embed' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'whatsapp' => 'nullable|string'
        ]);

        if (!$contact) {
            $contact = new ContactInfo();
            // Set default value jika kosong
            $validated['address'] = $validated['address'] ?? 'Belum diisi';
            $validated['phone'] = $validated['phone'] ?? 'Belum diisi';
            $validated['email'] = $validated['email'] ?? 'Belum diisi';
        }

        $contact->fill($validated);
        $contact->save();

        return redirect()->route('admin.contact.index')
            ->with('success', '✅ Informasi kontak berhasil diperbarui!');
    }
}