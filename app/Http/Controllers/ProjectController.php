<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // ১. ইনডেক্স মেথড (প্রোজেক্ট লিস্ট দেখানোর জন্য)
    public function index(Request $request)
    {
        $query = Project::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('classification')) {
            $query->where('classification', $request->classification);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $projects = $query->latest()->paginate(6);
        return view('admin.projects.index', compact('projects'));
    }

    // ২. ক্রিয়েট মেথড (ফর্ম দেখানোর জন্য)
    public function create()
    {
        return view('admin.projects.form');
    }

    // ৩. স্টোর মেথড (নতুন প্রোজেক্ট ডাটাবেজে সেভ করার জন্য)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                => 'required|string|max:255',
            'classification'      => 'required|in:residential,commercial,industrial',
            'status'              => 'required|in:ongoing,completed,upcoming',
            'progress_foundation' => 'nullable|integer|min:0|max:100',
            'progress_casting'    => 'nullable|integer|min:0|max:100',
            'progress_finishing'  => 'nullable|integer|min:0|max:100',
            'description'         => 'required|string',
            'body'                => 'nullable|string',
            'location'            => 'required|string',
            'address'             => 'nullable|string',
            'plot_size'           => 'nullable|string',
            'floors'              => 'nullable|integer',
            'units'               => 'nullable|integer',
            'size_range'          => 'nullable|string',
            'price_range'         => 'nullable|string',
            'handover_date'       => 'nullable|date',
            'rajuk_no'            => 'nullable|string',
            'amenities'           => 'nullable|array',
            'visibility'          => 'required|in:public,draft',
            'is_featured'         => 'nullable|boolean',
            'slug'                => 'required|string|unique:projects,slug',
            'meta_title'          => 'nullable|string|max:255',
            'meta_description'    => 'nullable|string',
            'cover_image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'gallery'             => 'nullable|array',
            'gallery.*'           => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // চেকবক্স হ্যান্ডেলিং
        $validated['is_featured'] = $request->has('is_featured');
        
        // Amenities জেসন ফরম্যাটে রূপান্তর
        $validated['amenities'] = json_encode($request->input('amenities', []));

        // Cover Image আপলোড লজিক
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
        }

        // Gallery মাল্টিপল ইমেজ আপলোড লজিক
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('projects/gallery', 'public');
            }
            $validated['gallery'] = json_encode($galleryPaths);
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    // ৪. এডিট মেথড (ডাটা সহ এডিট ফর্ম দেখানোর জন্য)
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.form', compact('project'));
    }

    // ৫. আপডেট মেথড (বিদ্যমান প্রোজেক্ট ডাটাবেজে আপডেট করার জন্য)
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'name'                => 'required|string|max:255',
            'classification'      => 'required|in:residential,commercial,industrial',
            'status'              => 'required|in:ongoing,completed,upcoming',
            'progress_foundation' => 'nullable|integer|min:0|max:100',
            'progress_casting'    => 'nullable|integer|min:0|max:100',
            'progress_finishing'  => 'nullable|integer|min:0|max:100',
            'description'         => 'required|string',
            'body'                => 'nullable|string',
            'location'            => 'required|string',
            'address'             => 'nullable|string',
            'plot_size'           => 'nullable|string',
            'floors'              => 'nullable|integer',
            'units'               => 'nullable|integer',
            'size_range'          => 'nullable|string',
            'price_range'         => 'nullable|string',
            'handover_date'       => 'nullable|date',
            'rajuk_no'            => 'nullable|string',
            'amenities'           => 'nullable|array',
            'visibility'          => 'required|in:public,draft',
            'is_featured'         => 'nullable|boolean',
            'slug'                => 'required|string|unique:projects,slug,' . $project->id,
            'meta_title'          => 'nullable|string|max:255',
            'meta_description'    => 'nullable|string',
            'cover_image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'gallery'             => 'nullable|array',
            'gallery.*'           => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['amenities'] = json_encode($request->input('amenities', []));

        // নতুন Cover Image আসলে আগের ইমেজ ডিলিট করে আপডেট করবে
        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
        }

        // নতুন Gallery ইমেজ আসলে আগেরগুলোর সাথে মার্জ বা রিপ্লেস করা (এখানে রিপ্লেস লজিক দেওয়া হলো)
        if ($request->hasFile('gallery')) {
            // পুরনো গ্যালারি ইমেজ ডিলিট করা
            if ($project->gallery) {
                $oldGallery = json_decode($project->gallery, true) ?: [];
                foreach ($oldGallery as $oldImg) {
                    Storage::disk('public')->delete($oldImg);
                }
            }

            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('projects/gallery', 'public');
            }
            $validated['gallery'] = json_encode($galleryPaths);
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    // ৬. ডিস্ট্রয় মেথড (প্রোজেক্ট ডিলিট করার জন্য)
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // সব ইমেজ স্টোরেজ থেকে ডিলিট করা
        if ($project->cover_image) {
            Storage::disk('public')->delete($project->cover_image);
        }

        if ($project->gallery) {
            $gallery = json_decode($project->gallery, true) ?: [];
            foreach ($gallery as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }

    // ৭. শো মেথড (ফ্রন্টএন্ড সিঙ্গেল ভিউ)
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('projects.show', compact('project'));
    }
}