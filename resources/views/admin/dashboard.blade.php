@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Welcome back! Here\'s what\'s happening today.')

@section('content')

{{-- ===== STAT CARDS ===== --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    @php
    $stats = [
        [
            'label'  => 'Total Projects', 
            'value'  => $totalProjects, 
            'change' => $newProjectsThisMonth > 0 ? "+{$newProjectsThisMonth} this month" : 'No new projects',  
            'up'     => $newProjectsThisMonth > 0 ? true : null,  
            'color'  => 'brand',  
            'icon'   => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5'
        ],
        [
            'label'  => 'Active Leads',   
            'value'  => $activeLeads,   
            'change' => $newLeadsThisWeek > 0 ? "+{$newLeadsThisWeek} this week" : 'No new leads',   
            'up'     => $newLeadsThisWeek > 0 ? true : null,   
            'color'  => 'blue',   
            'icon'   => 'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z'
        ],
        [
            'label'  => 'Blog Posts',     
            'value'  => $totalBlogs,     
            'change' => $newBlogsThisMonth > 0 ? "+{$newBlogsThisMonth} this month" : 'No new posts', 
            'up'     => $newBlogsThisMonth > 0 ? true : null, 
            'color'  => 'purple', 
            'icon'   => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'
        ],
        [
            'label'  => 'Team Members',   
            'value'  => $totalTeam,    
            'change' => 'Total active team',      
            'up'     => null,  
            'color'  => 'green',  
            'icon'   => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'
        ],
    ];

    $colorMap = [
        'brand'  => ['bg'=>'bg-brand/10',  'text'=>'text-brand',  'ring'=>'ring-brand/20'],
        'blue'   => ['bg'=>'bg-blue-50',   'text'=>'text-blue-600','ring'=>'ring-blue-200'],
        'purple' => ['bg'=>'bg-purple-50', 'text'=>'text-purple-600','ring'=>'ring-purple-200'],
        'green'  => ['bg'=>'bg-green-50',  'text'=>'text-green-600','ring'=>'ring-green-200'],
    ];
    @endphp

    @foreach($stats as $stat)
    @php $c = $colorMap[$stat['color']]; @endphp
    <div class="stat-card bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-start justify-between mb-4">
            <div class="w-11 h-11 {{ $c['bg'] }} rounded-xl flex items-center justify-center ring-4 {{ $c['ring'] }}">
                <svg class="w-5 h-5 {{ $c['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                </svg>
            </div>
            @if($stat['up'] !== null)
            <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $stat['up'] ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-600' }}">
                {{ $stat['up'] ? '↑' : '↓' }}
            </span>
            @endif
        </div>
        <div class="font-heading font-black text-3xl text-dark mb-0.5">{{ $stat['value'] }}</div>
        <div class="text-muted text-sm font-medium">{{ $stat['label'] }}</div>
        <div class="text-xs text-muted/70 mt-1">{{ $stat['change'] }}</div>
    </div>
    @endforeach
</div>


{{-- ===== ROW 2: Project Overview + Lead Funnel ===== --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-5">

    {{-- Project Status Breakdown --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="font-heading font-bold text-dark text-base">Project Status Overview</h3>
        <a href="{{ route('admin.projects.index') }}" class="text-brand text-xs font-semibold hover:underline">View All →</a>
    </div>

    {{-- Status breakdown bars --}}
    @php
    $statuses = [
        ['label' => 'Ongoing',   'count' => $ongoingCount,   'pct' => $ongoingPct,   'color' => 'bg-brand'],
        ['label' => 'Completed', 'count' => $completedCount, 'pct' => $completedPct, 'color' => 'bg-green-500'],
        ['label' => 'Upcoming',  'count' => $upcomingCount,  'pct' => $upcomingPct,  'color' => 'bg-blue-500'],
    ];
    @endphp

    <div class="space-y-4 mb-6">
        @foreach($statuses as $s)
        <div>
            <div class="flex justify-between items-center mb-1.5">
                <span class="text-sm font-medium text-dark">{{ $s['label'] }}</span>
                <span class="text-sm font-heading font-bold text-dark">
                    {{ $s['count'] }} 
                    <span class="text-muted font-normal text-xs">/ {{ $totalProjects }}</span>
                </span>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-2.5">
                <div class="{{ $s['color'] }} h-2.5 rounded-full transition-all duration-500" style="width:{{ $s['pct'] }}%"></div>
            </div>
        </div>
        @endforeach
    </div>

    @php
    $types = [
        ['label' => 'Residential', 'count' => $residentialCount, 'text_color' => 'text-brand',      'bg_color' => 'bg-brand/10'],
        ['label' => 'Commercial',  'count' => $commercialCount,  'text_color' => 'text-blue-600',  'bg_color' => 'bg-blue-50'],
        ['label' => 'Industrial',  'count' => $industrialCount,  'text_color' => 'text-purple-600','bg_color' => 'bg-purple-50']
    ];
    @endphp

    <div class="grid grid-cols-3 gap-3 pt-4 border-t border-gray-100">
        @foreach($types as $t)
        <div class="text-center {{ $t['bg_color'] }} rounded-xl py-3">
            <div class="font-heading font-black text-2xl {{ $t['text_color'] }}">{{ $t['count'] }}</div>
            <div class="text-muted text-xs mt-0.5">{{ $t['label'] }}</div>
        </div>
        @endforeach
    </div>
</div>

    {{-- Lead Funnel --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        {{-- <div class="flex items-center justify-between mb-6">
            <h3 class="font-heading font-bold text-dark text-base">Lead Funnel</h3>
            <a href="{{ route('admin.leads.index') }}" class="text-brand text-xs font-semibold hover:underline">View All →</a>
        </div> --}}
        <div class="space-y-3">
            @php $funnel = [
                ['stage'=>'New Inquiries',    'count'=>12, 'color'=>'bg-purple-500', 'w'=>'w-full'],
                ['stage'=>'Contacted',         'count'=>28, 'color'=>'bg-blue-500',   'w'=>'w-4/5'],
                ['stage'=>'Site Visit Booked', 'count'=>15, 'color'=>'bg-brand',      'w'=>'w-3/5'],
                ['stage'=>'Negotiation',       'count'=>7,  'color'=>'bg-yellow-500', 'w'=>'w-2/5'],
                ['stage'=>'Closed / Won',      'count'=>4,  'color'=>'bg-green-500',  'w'=>'w-1/4'],
            ]; @endphp
            @foreach($funnel as $f)
            <div>
                <div class="flex justify-between text-xs mb-1 text-muted">
                    <span>{{ $f['stage'] }}</span>
                    <span class="font-bold text-dark">{{ $f['count'] }}</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                    <div class="{{ $f['color'] }} h-2 rounded-full {{ $f['w'] }}"></div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-5 pt-4 border-t border-gray-100 text-center">
            <div class="font-heading font-black text-2xl text-green-600">4</div>
            <div class="text-muted text-xs mt-0.5">Deals closed this month</div>
        </div>
    </div>
</div>


{{-- ===== ROW 3: Recent Leads + Recent Blog + Quick Actions ===== --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    {{-- Recent Leads Table --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-heading font-bold text-dark text-base">Recent Leads</h3>
            <a href="{{ route('admin.contacts.index') }}" class="text-brand text-xs font-semibold hover:underline">View All →</a>
        </div>
        <div class="overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr class="bg-light">
                <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3">Name</th>
                <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden sm:table-cell">Type</th>
                <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden md:table-cell">Date</th>
                <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3">Status</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($recentLeads as $lead)
            <tr>
                <td class="px-5 py-3.5">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-brand/10 flex items-center justify-center shrink-0">
                            <span class="font-heading font-black text-brand text-xs">
                                {{ strtoupper(substr($lead->name, 0, 1)) }}
                            </span>
                        </div>
                        <span class="font-medium text-dark text-sm">{{ $lead->name }}</span>
                    </div>
                </td>
                
                <td class="px-5 py-3.5 hidden sm:table-cell text-muted text-xs">
                    {{ $lead->type ?? 'General Inquiry' }}
                </td>
                
                <td class="px-5 py-3.5 hidden md:table-cell text-muted text-xs">
                    @if($lead->created_at->isToday())
                        Today, {{ $lead->created_at->format('g:i A') }}
                    @elseif($lead->created_at->isYesterday())
                        Yesterday, {{ $lead->created_at->format('g:i A') }}
                    @else
                        {{ $lead->created_at->format('M d, g:i A') }}
                    @endif
                </td>
                
                <td class="px-5 py-3.5">
                    @php
                        $statusClasses = [
                            'unread'       => 'bg-blue-50 text-blue-700',
                            'contacted' => 'bg-yellow-50 text-yellow-700',
                            'read'    => 'bg-green-50 text-green-700',
                            'closed'    => 'bg-gray-100 text-gray-600',
                        ];
                        $badgeClass = $statusClasses[$lead->status] ?? 'bg-gray-100 text-gray-600';
                    @endphp
                    <span class="text-xs font-heading font-semibold px-2.5 py-1 rounded-full {{ $badgeClass }}">
                        {{ ucfirst($lead->status) }}
                    </span>
                </td>
                
                {{-- অ্যাকশন বাটন --}}
                <td class="px-5 py-3.5 text-right">
                    {{-- আপনার লিড বা কন্টাক্ট মেসেজ দেখার রাউটের নাম এখানে বসাতে পারেন --}}
                    {{-- <a href="{{ route('admin.contacts.show', $lead->id) }}" class="text-brand hover:text-brand-dark text-xs font-semibold">View →</a> --}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-6 text-muted text-sm">
                    No recent leads found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
    </div>

    {{-- Right Column --}}
    <div class="space-y-5">

        {{-- Recent Blog Posts --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-heading font-bold text-dark text-base">Recent Posts</h3>
        <a href="{{ route('admin.blogs.index') }}" class="text-brand text-xs font-semibold hover:underline">All →</a>
    </div>
    
            <div class="space-y-3">
                @forelse($recentPosts as $post)
                <div class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full mt-2 shrink-0 {{ $post->status === 'Published' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                    
                    <div class="min-w-0 flex-1">
                        <p class="text-dark text-xs font-medium leading-snug truncate" title="{{ $post->title }}">
                            {{ $post->title }}
                        </p>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="text-muted text-xs">{{ $post->created_at->format('M d') }}</span>
                            
                            <span class="text-xs px-2 py-0.5 rounded-full font-semibold {{ $post->status === 'Published' ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-muted text-xs">
                    No recent posts found.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection