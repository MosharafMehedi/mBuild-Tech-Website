{{-- resources/views/admin/projects/index.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Projects')
@section('page-title', 'Projects')
@section('breadcrumb', 'Admin / Projects')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <div class="flex gap-2">
        {{-- স্ট্যাটাস ফিল্টারিং লিংক (কন্ট্রোলার থেকে ফিল্টার রিকোয়েস্ট হ্যান্ডেল করার সুবিধার্থে) --}}
        @foreach(['All', 'Ongoing', 'Completed', 'Upcoming'] as $f)
        @php $slugStatus = strtolower($f); @endphp
        <a href="{{ route('admin.projects.index', ['status' => $slugStatus !== 'all' ? $slugStatus : null]) }}" 
           class="px-3.5 py-1.5 rounded-lg text-xs font-heading font-semibold transition-all
            {{ (request('status', 'all') === $slugStatus) ? 'bg-brand text-white' : 'bg-white border border-gray-200 text-muted hover:border-brand hover:text-dark' }}">
            {{ $f }}
        </a>
        @endforeach
    </div>
    
    {{-- Add New Project বাটনটি কমেন্ট আউট থেকে মুক্ত করা হলো --}}
    <a href="{{ route('admin.projects.create') }}" class="flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-heading font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Add New Project
    </a>
</div>

{{-- সাকসেস মেসেজ অ্যালার্ট --}}
@if(session('success'))
<div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    {{-- ফিল্টার এবং সার্চ ফর্ম --}}
    <form action="{{ route('admin.projects.index') }}" method="GET" class="px-5 py-4 border-b border-gray-100 flex flex-wrap items-center gap-3">
        @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        
        <div class="relative flex-1 min-w-[200px] max-w-xs">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search projects..." class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand"/>
        </div>
        
        <select name="classification" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand bg-white">
            <option value="">All Classifications</option>
            <option value="residential" {{ request('classification') === 'residential' ? 'selected' : '' }}>Residential</option>
            <option value="commercial" {{ request('classification') === 'commercial' ? 'selected' : '' }}>Commercial</option>
            <option value="industrial" {{ request('classification') === 'industrial' ? 'selected' : '' }}>Industrial</option>
        </select>

        <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-dark text-sm px-4 py-2 rounded-lg transition-colors font-medium">Filter</button>
        @if(request()->anyFilled(['search', 'classification', 'status']))
            <a href="{{ route('admin.projects.index') }}" class="text-xs text-red-500 hover:underline">Clear Filters</a>
        @endif
    </form>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-light">
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3">Project</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden md:table-cell">Classification</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden lg:table-cell">Location</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3">Status</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden xl:table-cell">Overall Progress</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden lg:table-cell">Handover Date</th>
                    <th class="px-5 py-3 text-right text-xs font-heading font-semibold text-muted uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                {{-- ডাটাবেজ থেকে আসা প্রোজেক্ট লুপ --}}
                @forelse($projects as $p)
                @php
                    // ৩টি প্রগ্রেস ফিল্ডের গড় (Average) বের করার লজিক
                    $avgProgress = round(($p->progress_foundation + $p->progress_casting + $p->progress_finishing) / 3);
                @endphp
                <tr>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            @if($p->cover_image)
                                <img src="{{ asset('storage/' . $p->cover_image) }}" class="w-10 h-10 rounded-lg object-cover shrink-0"/>
                            @else
                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center shrink-0 text-gray-400 text-xs font-bold">No Img</div>
                            @endif
                            <span class="font-medium text-dark text-sm leading-snug max-w-[180px]">{{ $p->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 hidden md:table-cell text-muted text-sm capitalize">{{ $p->classification }}</td>
                    <td class="px-5 py-3.5 hidden lg:table-cell text-muted text-sm">{{ $p->location }}</td>
                    <td class="px-5 py-3.5">
                        <span class="px-2.5 py-1 rounded-full text-xs font-heading font-semibold capitalize 
                            {{ $p->status === 'completed' ? 'bg-green-50 text-green-700' : ($p->status === 'ongoing' ? 'bg-blue-50 text-blue-700' : 'bg-yellow-50 text-yellow-700') }}">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 hidden xl:table-cell">
                        <div class="flex items-center gap-2 w-24">
                            <div class="flex-1 bg-gray-100 rounded-full h-1.5">
                                <div class="bg-brand h-1.5 rounded-full" style="width: {{ $avgProgress }}%"></div>
                            </div>
                            <span class="text-xs text-muted font-medium">{{ $avgProgress }}%</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 hidden lg:table-cell text-muted text-sm">
                        {{ $p->handover_date ? \Carbon\Carbon::parse($p->handover_date)->format('M Y') : 'N/A' }}
                    </td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center justify-end gap-2">
                            {{-- Edit বাটন একটিভ করা হলো --}}
                            <a href="{{ route('admin.projects.edit', $p->id) }}" class="p-1.5 text-muted hover:text-brand hover:bg-brand-light rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            {{-- Front Site View বাটন একটিভ করা হলো --}}
                            <a href="{{ route('projects.show', $p->slug) }}" target="_blank" class="p-1.5 text-muted hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="View on site">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            {{-- Delete বাটন --}}
                            <button onclick="openDeleteModal('{{ route('admin.projects.destroy', $p->id) }}')" class="p-1.5 text-muted hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-10 text-muted text-sm">No projects found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- লারাভেল ডায়নামিক পেজিনেশন লিঙ্ক --}}
    <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-between">
        <p class="text-muted text-sm">
            Showing <strong class="text-dark">{{ $projects->firstItem() ?? 0 }}</strong> to <strong class="text-dark">{{ $projects->lastItem() ?? 0 }}</strong> of <strong class="text-dark">{{ $projects->total() }}</strong> projects
        </p>
        <div>
            {{ $projects->appends(request()->query())->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>
</div>

{{-- Delete confirm modal (ডায়নামিক ফর্ম সহ) --}}
<div id="delete-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-2xl">
        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </div>
        <h3 class="font-heading font-bold text-dark text-lg text-center mb-2">Delete Project?</h3>
        <p class="text-muted text-sm text-center mb-6">This action will safely move this project to trash (Soft Delete).</p>
        
        {{-- এখানে ডায়নামিকালি অ্যাকশন ইউআরএল সেট হবে JS এর মাধ্যমে --}}
        <form id="delete-project-form" method="POST" class="flex gap-3">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDelete()" class="flex-1 border border-gray-200 text-dark font-semibold text-sm py-2.5 rounded-xl hover:bg-gray-50 transition-colors">Cancel</button>
            <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold text-sm py-2.5 rounded-xl transition-colors">Delete</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
// ডিলিট মডাল ওপেন এবং ডায়নামিক অ্যাকশন ইউআরএল সেট করার স্ক্রিপ্ট
function openDeleteModal(actionUrl) {
    document.getElementById('delete-project-form').setAttribute('action', actionUrl);
    document.getElementById('delete-modal').classList.remove('hidden');
}

function closeDelete() {
    document.getElementById('delete-modal').classList.add('hidden');
}
</script>
@endpush
@endsection