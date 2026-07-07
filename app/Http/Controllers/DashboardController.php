<?php

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Contact_us;
use App\Models\Project;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $newProjectsThisMonth = Project::where('created_at', '>=', Carbon::now()->startOfMonth())->count();

        $activeLeads = Contact_us::where('status', 'active')->count();
        $newLeadsThisWeek = Contact_us::where('status', 'active')
            ->where('created_at', '>=', Carbon::now()->startOfWeek())
            ->count();

        $totalBlogs = Blog::count();
        $newBlogsThisMonth = Blog::where('created_at', '>=', Carbon::now()->startOfMonth())->count();

        return view('admin.dashboard', compact(
            'totalProjects',
            'newProjectsThisMonth',
            'activeLeads',
            'newLeadsThisWeek',
            'totalBlogs',
            'newBlogsThisMonth',
            'totalTeam'
        ));
    }
}
