<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Faq;
use App\Models\Metric;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the single route for home page
     * and load both FAQs and Testimonials.
     */
    public function index()
    {
        $metrics = Metric::orderBy('sort_order', 'asc')->get();
        $projects = Project::where('visibility', 'public')
            ->latest()
            ->take(6)
            ->get();
        $featuredProject = Project::where('is_featured', true)
            ->latest()
            ->first();
        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('display_order', 'asc')
            ->get();

        $latestPosts = Blog::where('status', 'Published')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('home', compact('faqs', 'testimonials', 'metrics', 'projects', 'latestPosts', 'featuredProject'));
    }
}
