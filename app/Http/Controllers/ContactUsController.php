<?php

namespace App\Http\Controllers;
use App\Models\Contact_us;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'phone'        => 'nullable|string|max:20',
            'inquiry_type' => 'required|string|max:100',
            'message'      => 'required|string|max:3000',
        ]);

        $validated['status'] = 'unread';

        Contact_us::create($validated);

            return back()->with('success', 'Thank you! Your message has been received. Our team will contact you within 24 hours.');
    }

    public function index(Request $request)
    {
        $query = Contact_us::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $contacts = $query->latest()->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact_us::findOrFail($id);
        $contact->update(['status' => 'read', 'read_at' => now()]);

        return view('admin.contacts.show', compact('contact'));
    }

    public function markRead($id)
{
    $contact = Contact_us::findOrFail($id);
    
    $contact->read_at = now();
    $contact->status = 'read';
    $contact->save();

    return back()->with('success', 'Message marked as read!');
}

    public function destroy($id)
    {
        $contact = Contact_us::findOrFail($id);
        $contact->delete();

        return back()->with('success', 'Contact deleted successfully!');
    }
}
