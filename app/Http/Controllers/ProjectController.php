<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function allProjects()
    {
        $allProjects = Project::where('visibility', 'public')
            ->latest()
            ->get();

        return view('projects.index', compact('allProjects'));
    }
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

    public function create()
    {
        return view('admin.projects.form');
    }

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
            'brochure_file'       => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        $validated['amenities'] = json_encode($request->input('amenities', []));

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('projects/gallery', 'public');
            }
            $validated['gallery'] = json_encode($galleryPaths);
        }
        if ($request->hasFile('brochure_file')) {
            $validated['brochure_file'] = $request->file('brochure_file')->store('projects/brochures', 'public');
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.form', compact('project'));
    }

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
            'brochure_file'       => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['amenities'] = json_encode($request->input('amenities', []));

        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
        }

        if ($request->hasFile('gallery')) {
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

        if ($request->hasFile('brochure_file')) {
            if ($project->brochure_file) {
                Storage::disk('public')->delete($project->brochure_file);
            }
            $validated['brochure_file'] = $request->file('brochure_file')->store('projects/brochures', 'public');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

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

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('visibility', 'public')
            ->firstOrFail();

        return view('projects.show', compact('project'));
    }
}
