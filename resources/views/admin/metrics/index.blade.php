@extends('admin.layouts.app')
@section('title', 'Metrics')
@section('page-title', 'Metrics')
@section('breadcrumb', 'Admin / Metrics')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    
    {{-- Add New Metric বাটন --}}
    <a href="{{ route('admin.metrics.create') }}" class="flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-heading font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Add New Metric
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

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-light">
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3">Metric</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden md:table-cell">Category</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden lg:table-cell">Value</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden xl:table-cell">Suffix</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden lg:table-cell">Order</th>
                    <th class="px-5 py-3 text-right text-xs font-heading font-semibold text-muted uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                {{-- ডাটাবেজ থেকে আসা মেট্রিক লুপ --}}
                @forelse($metrics as $metric)
                <tr>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            @if($metric->icon)
                                <div class="w-10 h-10 bg-brand/10 rounded-lg flex items-center justify-center shrink-0 text-brand">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $metric->icon }}"/>
                                    </svg>
                                </div>
                            @else
                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center shrink-0 text-gray-400 text-xs font-bold">No Icon</div>
                            @endif
                            <span class="font-medium text-dark text-sm leading-snug max-w-[180px]">{{ $metric->label }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 hidden md:table-cell">
                        <span class="px-2.5 py-1 rounded-full text-xs font-heading font-semibold capitalize bg-purple-50 text-purple-700">
                            {{ $metric->category ?? 'General' }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 hidden lg:table-cell">
                        <span class="font-bold text-brand text-sm">{{ $metric->value }}</span>
                    </td>
                    <td class="px-5 py-3.5 hidden xl:table-cell text-muted text-sm">{{ $metric->suffix ?? '—' }}</td>
                    <td class="px-5 py-3.5 hidden lg:table-cell text-muted text-sm text-center">{{ $metric->sort_order ?? 0 }}</td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center justify-end gap-2">
                            {{-- Edit বাটন --}}
                            <a href="{{ route('admin.metrics.edit', $metric->id) }}" class="p-1.5 text-muted hover:text-brand hover:bg-brand-light rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            {{-- Toggle Status বাটন --}}
                            {{-- <button onclick="toggleStatus('{{ route('admin.metrics.toggle', $metric->id) }}')" class="p-1.5 text-muted hover:text-{{ $metric->is_active ? 'yellow' : 'green' }}-600 hover:bg-{{ $metric->is_active ? 'yellow' : 'green' }}-50 rounded-lg transition-colors" title="{{ $metric->is_active ? 'Deactivate' : 'Activate' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($metric->is_active)
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @endif
                                </svg>
                            </button> --}}
                            {{-- Delete বাটন --}}
                            <button onclick="openDeleteModal('{{ route('admin.metrics.destroy', $metric->id) }}')" class="p-1.5 text-muted hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-10 text-muted text-sm">No metrics found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Delete confirm modal (ডায়নামিক ফর্ম সহ) --}}
<div id="delete-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-2xl">
        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </div>
        <h3 class="font-heading font-bold text-dark text-lg text-center mb-2">Delete Metric?</h3>
        <p class="text-muted text-sm text-center mb-6">This action will permanently delete this metric.</p>
        
        {{-- এখানে ডায়নামিকালি অ্যাকশন ইউআরএল সেট হবে JS এর মাধ্যমে --}}
        <form id="delete-metric-form" method="POST" class="flex gap-3">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDelete()" class="flex-1 border border-gray-200 text-dark font-semibold text-sm py-2.5 rounded-xl hover:bg-gray-50 transition-colors">Cancel</button>
            <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold text-sm py-2.5 rounded-xl transition-colors">Delete</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openDeleteModal(actionUrl) {
    document.getElementById('delete-metric-form').setAttribute('action', actionUrl);
    document.getElementById('delete-modal').classList.remove('hidden');
}

function closeDelete() {
    document.getElementById('delete-modal').classList.add('hidden');
}


</script>
@endpush
@endsection