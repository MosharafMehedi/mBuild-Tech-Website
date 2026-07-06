<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display all testimonials.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('display_order')->orderBy('created_at', 'desc')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Store a new testimonial.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:150',
            'role'          => 'required|string|max:150',
            'text'          => 'required|string|max:300',
            'stars'         => 'required|integer|min:1|max:5',
            'display_order' => 'nullable|integer|min:1|max:99',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'     => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $data['is_active']     = $request->boolean('is_active', true);
        $data['display_order'] = $data['display_order'] ?? (Testimonial::max('display_order') + 1);

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', "Testimonial from \"{$data['name']}\" added successfully!");
    }

    /**
     * Update an existing testimonial.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:150',
            'role'          => 'required|string|max:150',
            'text'          => 'required|string|max:300',
            'stars'         => 'required|integer|min:1|max:5',
            'display_order' => 'nullable|integer|min:1|max:99',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'     => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($testimonial->photo) {
                \Storage::disk('public')->delete($testimonial->photo);
            }
            $data['photo'] = $request->file('photo')->store('testimonials', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', "Testimonial from \"{$testimonial->name}\" updated successfully!");
    }

    /**
     * Toggle active/hidden status.
     */
    public function toggle(Testimonial $testimonial)
    {
        $testimonial->update(['is_active' => !$testimonial->is_active]);

        $status = $testimonial->is_active ? 'visible' : 'hidden';

        return redirect()->route('admin.testimonials.index')
            ->with('success', "Testimonial marked as {$status}.");
    }

    /**
     * Delete a testimonial.
     */
    public function destroy(Testimonial $testimonial)
    {
        $name = $testimonial->name;

        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', "Testimonial from \"{$name}\" deleted.");
    }
}
