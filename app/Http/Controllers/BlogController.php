<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::query();

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $blogs = $query->latest('published_at')->paginate(15);
        $categories = Blog::distinct()->pluck('category')->filter();
        
        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    public function publicIndex(Request $request)
    {
        $query = Blog::query()->where('status', 'Published');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $blogs = $query->latest('published_at')->paginate(9);
        $categories = Blog::where('status', 'Published')->distinct()->pluck('category')->filter();
        
        return view('blog.index', compact('blogs', 'categories'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
                ->where('status', 'Published')
                ->firstOrFail();

    $blog->increment('views');

    $relatedBlogs = Blog::where('category', $blog->category)
                        ->where('id', '!=', $blog->id)
                        ->where('status', 'Published')
                        ->latest('published_at')
                        ->take(3)
                        ->get();
        
        return view('blog.show', compact('blog', 'relatedBlogs'));
    }

    public function create()
    {
        $blog = new Blog(); 
        return view('admin.blogs.form', compact('blog'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'required|string|unique:blogs,slug',
            'category'         => 'required|string|max:100',
            'status'           => ['required', Rule::in(['Published', 'Draft'])],
            'content'          => 'required|string',
            'excerpt'          => 'required|string|max:500',
            'author'           => 'required|string|max:100',
            'featured_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'published_at'     => 'required|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.form', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'required|string|unique:blogs,slug,' . $blog->id,
            'category'         => 'required|string|max:100',
            'status'           => ['required', Rule::in(['Published', 'Draft'])],
            'content'          => 'required|string',
            'excerpt'          => 'required|string|max:500',
            'author'           => 'required|string|max:100',
            'featured_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'published_at'     => 'required|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return back()->with('success', 'Blog deleted successfully!');
    }
}