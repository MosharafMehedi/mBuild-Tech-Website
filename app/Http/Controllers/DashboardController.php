<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Contact_us;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $newProjectsThisMonth = Project::where('created_at', '>=', Carbon::now()->startOfMonth())->count();

        $activeLeads = Contact_us::where('status', 'unread')->count();
        $newLeadsThisWeek = Contact_us::where('status', 'unread')
            ->where('created_at', '>=', Carbon::now()->startOfWeek())
            ->count();

        $totalBlogs = Blog::count();
        $newBlogsThisMonth = Blog::where('created_at', '>=', Carbon::now()->startOfMonth())->count();

        $totalTeam = User::count();
        $ongoingCount   = Project::where('status', 'ongoing')->count();
        $completedCount = Project::where('status', 'completed')->count();
        $upcomingCount  = Project::where('status', 'upcoming')->count();

        $divider = $totalProjects > 0 ? $totalProjects : 1;

        $ongoingPct   = round(($ongoingCount / $divider) * 100);
        $completedPct = round(($completedCount / $divider) * 100);
        $upcomingPct  = round(($upcomingCount / $divider) * 100);

        $residentialCount = Project::where('classification', 'residential')->count();
        $commercialCount  = Project::where('classification', 'commercial')->count();
        $industrialCount  = Project::where('classification', 'industrial')->count();

        $recentPosts = Blog::latest()->take(4)->get();
        $recentLeads = Contact_us::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProjects',
            'newProjectsThisMonth',
            'activeLeads',
            'newLeadsThisWeek',
            'totalBlogs',
            'newBlogsThisMonth',
            'totalTeam',
            'ongoingCount',
            'completedCount',
            'upcomingCount',
            'ongoingPct',
            'completedPct',
            'upcomingPct',
            'residentialCount',
            'commercialCount',
            'industrialCount',
            'recentPosts',
            'recentLeads'
        ));
    }
}
