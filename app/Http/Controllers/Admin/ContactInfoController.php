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
        }

        // Update SEMUA field (termasuk yang kosong)
        $contact->address = $validated['address'] ?? $contact->address;
        $contact->phone = $validated['phone'] ?? $contact->phone;
        $contact->email = $validated['email'] ?? $contact->email;
        $contact->description = $validated['description'] ?? $contact->description;
        $contact->map_embed = $validated['map_embed'] ?? $contact->map_embed;
        $contact->facebook = $validated['facebook'] ?? $contact->facebook;
        $contact->instagram = $validated['instagram'] ?? $contact->instagram;
        $contact->twitter = $validated['twitter'] ?? $contact->twitter;
        $contact->linkedin = $validated['linkedin'] ?? $contact->linkedin;
        $contact->whatsapp = $validated['whatsapp'] ?? $contact->whatsapp;

        $contact->save();

        return redirect()->route('admin.contact.index')
            ->with('success', '✅ Informasi kontak berhasil diperbarui!');
    }
}