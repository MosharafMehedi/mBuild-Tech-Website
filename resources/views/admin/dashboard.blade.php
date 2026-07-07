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
        {{-- <div class="flex items-center justify-between mb-6">
            <h3 class="font-heading font-bold text-dark text-base">Project Status Overview</h3>
            <a href="{{ route('admin.projects.index') }}" class="text-brand text-xs font-semibold hover:underline">View All →</a>
        </div> --}}

        {{-- Status breakdown bars --}}
        @php
        $statuses = [
            ['label'=>'Ongoing',   'count'=>12, 'pct'=>57, 'color'=>'bg-brand'],
            ['label'=>'Completed', 'count'=>7,  'pct'=>33, 'color'=>'bg-green-500'],
            ['label'=>'Upcoming',  'count'=>2,  'pct'=>10, 'color'=>'bg-blue-500'],
        ];
        @endphp
        <div class="space-y-4 mb-6">
            @foreach($statuses as $s)
            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <span class="text-sm font-medium text-dark">{{ $s['label'] }}</span>
                    <span class="text-sm font-heading font-bold text-dark">{{ $s['count'] }} <span class="text-muted font-normal text-xs">/ 21</span></span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="{{ $s['color'] }} h-2.5 rounded-full" style="width:{{ $s['pct'] }}%"></div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Type breakdown --}}
        <div class="grid grid-cols-3 gap-3 pt-4 border-t border-gray-100">
            @foreach([['Residential','14','text-brand','bg-brand/10'],['Commercial','5','text-blue-600','bg-blue-50'],['Industrial','2','text-purple-600','bg-purple-50']] as [$type,$cnt,$tc,$bc])
            <div class="text-center {{ $bc }} rounded-xl py-3">
                <div class="font-heading font-black text-2xl {{ $tc }}">{{ $cnt }}</div>
                <div class="text-muted text-xs mt-0.5">{{ $type }}</div>
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
        {{-- <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-heading font-bold text-dark text-base">Recent Leads</h3>
            <a href="{{ route('admin.leads.index') }}" class="text-brand text-xs font-semibold hover:underline">View All →</a>
        </div> --}}
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
                    @php $leads = [
                        ['name'=>'Md. Karim Hossain','type'=>'Buy a Property',   'date'=>'Today, 10:30 AM',    'status'=>'new'],
                        ['name'=>'Tahmina Begum',    'type'=>'Construct a Building','date'=>'Today, 9:15 AM',  'status'=>'contacted'],
                        ['name'=>'Arif Ahmed',       'type'=>'Buy a Property',   'date'=>'Yesterday, 4:00 PM', 'status'=>'contacted'],
                        ['name'=>'Nasrin Sultana',   'type'=>'General Inquiry',  'date'=>'Jun 30, 2:30 PM',    'status'=>'closed'],
                        ['name'=>'Rezaul Karim',     'type'=>'Buy a Property',   'date'=>'Jun 29, 11:00 AM',   'status'=>'new'],
                    ]; @endphp
                    @foreach($leads as $lead)
                    <tr>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-brand/10 flex items-center justify-center shrink-0">
                                    <span class="font-heading font-black text-brand text-xs">{{ substr($lead['name'],0,1) }}</span>
                                </div>
                                <span class="font-medium text-dark text-sm">{{ $lead['name'] }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 hidden sm:table-cell text-muted text-xs">{{ $lead['type'] }}</td>
                        <td class="px-5 py-3.5 hidden md:table-cell text-muted text-xs">{{ $lead['date'] }}</td>
                        <td class="px-5 py-3.5">
                            <span class="badge-{{ $lead['status'] }} text-xs font-heading font-semibold px-2.5 py-1 rounded-full capitalize">{{ $lead['status'] }}</span>
                        </td>
                        {{-- <td class="px-5 py-3.5 text-right">
                            <a href="{{ route('admin.leads.index') }}" class="text-brand hover:text-brand-dark text-xs font-semibold">View →</a>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Right Column --}}
    <div class="space-y-5">

        {{-- Quick Actions --}}
        {{-- <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-heading font-bold text-dark text-base mb-4">Quick Actions</h3>
            <div class="space-y-2.5">
                @foreach([
                    ['label'=>'Add New Project',  'href'=>route('admin.projects.create'), 'icon'=>'M12 6v6m0 0v6m0-6h6m-6 0H6', 'color'=>'brand'],
                    ['label'=>'Write Blog Post',  'href'=>route('admin.blog.create'),     'icon'=>'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z', 'color'=>'purple'],
                    ['label'=>'Add Team Member',  'href'=>route('admin.team.index'),      'icon'=>'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z', 'color'=>'blue'],
                    ['label'=>'Add Testimonial',  'href'=>route('admin.testimonials.index'),'icon'=>'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z', 'color'=>'green'],
                ] as $qa)
                @php $colors = ['brand'=>'bg-brand/10 text-brand hover:bg-brand hover:text-white','purple'=>'bg-purple-50 text-purple-600 hover:bg-purple-600 hover:text-white','blue'=>'bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white','green'=>'bg-green-50 text-green-600 hover:bg-green-600 hover:text-white']; @endphp
                <a href="{{ $qa['href'] }}" class="{{ $colors[$qa['color']] }} flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition-all">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $qa['icon'] }}"/></svg>
                    {{ $qa['label'] }}
                </a>
                @endforeach
            </div>
        </div> --}}

        {{-- Recent Blog Posts --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            {{-- <div class="flex items-center justify-between mb-4">
                <h3 class="font-heading font-bold text-dark text-base">Recent Posts</h3>
                <a href="{{ route('admin.blog.index') }}" class="text-brand text-xs font-semibold hover:underline">All →</a>
            </div> --}}
            <div class="space-y-3">
                @foreach([
                    ['title'=>'Real Estate Trends in Dhaka 2026','date'=>'Jun 10','status'=>'published'],
                    ['title'=>'Sustainable Construction Practices','date'=>'May 28','status'=>'published'],
                    ['title'=>'Smart Home Integration Guide',      'date'=>'May 15','status'=>'draft'],
                ] as $post)
                <div class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full mt-2 shrink-0 {{ $post['status'] === 'published' ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                    <div class="min-w-0 flex-1">
                        <p class="text-dark text-xs font-medium leading-snug truncate">{{ $post['title'] }}</p>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="text-muted text-xs">{{ $post['date'] }}</span>
                            <span class="badge-{{ $post['status'] }} text-xs px-2 py-0.5 rounded-full font-semibold">{{ ucfirst($post['status']) }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Website Live Status --}}
        <div class="bg-dark-2 rounded-2xl p-5">
            <h3 class="font-heading font-bold text-white text-sm mb-4">Website Status</h3>
            <div class="space-y-3">
                @foreach([
                    ['label'=>'Website Online',  'ok'=>true],
                    ['label'=>'SSL Certificate', 'ok'=>true],
                    ['label'=>'Database',        'ok'=>true],
                    ['label'=>'Storage / Disk',  'ok'=>true],
                ] as $s)
                <div class="flex items-center justify-between text-xs">
                    <span class="text-white/60">{{ $s['label'] }}</span>
                    <span class="{{ $s['ok'] ? 'text-green-400' : 'text-red-400' }} font-semibold flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full {{ $s['ok'] ? 'bg-green-400' : 'bg-red-400' }}"></span>
                        {{ $s['ok'] ? 'OK' : 'Issue' }}
                    </span>
                </div>
                @endforeach
            </div>
            <a href="{{ route('home') }}" target="_blank" class="mt-4 block w-full bg-brand hover:bg-brand-dark text-white text-xs font-heading font-bold py-2.5 rounded-xl text-center transition-colors">
                Open Live Website ↗
            </a>
        </div>
    </div>
</div>

@endsection