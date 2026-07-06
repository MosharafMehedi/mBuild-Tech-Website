@extends('admin.layouts.app')
@section('title', 'FAQs')
@section('page-title', 'FAQs')
@section('breadcrumb', 'Admin / FAQs')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <div class="flex gap-2">
        {{-- স্ট্যাটাস ফিল্টারিং লিংক --}}
        @foreach(['All', 'Active', 'Inactive'] as $f)
        @php $slugStatus = strtolower($f); @endphp
        <a href="{{ route('admin.faqs.index', ['status' => $slugStatus !== 'all' ? $slugStatus : null]) }}" 
           class="px-3.5 py-1.5 rounded-lg text-xs font-heading font-semibold transition-all
            {{ (request('status', 'all') === $slugStatus) ? 'bg-brand text-white' : 'bg-white border border-gray-200 text-muted hover:border-brand hover:text-dark' }}">
            {{ $f }}
        </a>
        @endforeach
    </div>
    
    {{-- Add New FAQ বাটন --}}
    <a href="{{ route('admin.faqs.create') }}" class="flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-heading font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Add New FAQ
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
    <form action="{{ route('admin.faqs.index') }}" method="GET" class="px-5 py-4 border-b border-gray-100 flex flex-wrap items-center gap-3">
        @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        
        <div class="relative flex-1 min-w-[200px] max-w-xs">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search FAQs..." class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand"/>
        </div>
        
        <select name="category" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand bg-white">
            <option value="">All Categories</option>
            <option value="general" {{ request('category') === 'general' ? 'selected' : '' }}>General</option>
            <option value="booking" {{ request('category') === 'booking' ? 'selected' : '' }}>Booking</option>
            <option value="payment" {{ request('category') === 'payment' ? 'selected' : '' }}>Payment</option>
            <option value="construction" {{ request('category') === 'construction' ? 'selected' : '' }}>Construction</option>
            <option value="handover" {{ request('category') === 'handover' ? 'selected' : '' }}>Handover</option>
        </select>

        <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-dark text-sm px-4 py-2 rounded-lg transition-colors font-medium">Filter</button>
        @if(request()->anyFilled(['search', 'category', 'status']))
            <a href="{{ route('admin.faqs.index') }}" class="text-xs text-red-500 hover:underline">Clear Filters</a>
        @endif
    </form>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-light">
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3">Question</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden md:table-cell">Category</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3">Status</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden lg:table-cell">Sort Order</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden xl:table-cell">Created</th>
                    <th class="px-5 py-3 text-right text-xs font-heading font-semibold text-muted uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                {{-- ডাটাবেজ থেকে আসা FAQ লুপ --}}
                @forelse($faqs as $faq)
                <tr>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-brand-light rounded-lg flex items-center justify-center shrink-0 text-brand text-xs font-bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span class="font-medium text-dark text-sm leading-snug max-w-[300px] line-clamp-2">{{ $faq->question }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 hidden md:table-cell">
                        <span class="px-2.5 py-1 rounded-full text-xs font-heading font-semibold capitalize bg-purple-50 text-purple-700">
                            {{ $faq->category }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5">
                        <span class="px-2.5 py-1 rounded-full text-xs font-heading font-semibold capitalize 
                            {{ $faq->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $faq->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 hidden lg:table-cell text-muted text-sm text-center">{{ $faq->sort_order ?? 0 }}</td>
                    <td class="px-5 py-3.5 hidden xl:table-cell text-muted text-sm">
                        {{ $faq->created_at ? \Carbon\Carbon::parse($faq->created_at)->format('M d, Y') : 'N/A' }}
                    </td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center justify-end gap-2">
                            {{-- Edit বাটন --}}
                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="p-1.5 text-muted hover:text-brand hover:bg-brand-light rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            {{-- Toggle Status বাটন --}}
                            <button onclick="toggleStatus('{{ route('admin.faqs.toggle', $faq->id) }}')" class="p-1.5 text-muted hover:text-{{ $faq->is_active ? 'yellow' : 'green' }}-600 hover:bg-{{ $faq->is_active ? 'yellow' : 'green' }}-50 rounded-lg transition-colors" title="{{ $faq->is_active ? 'Deactivate' : 'Activate' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($faq->is_active)
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @endif
                                </svg>
                            </button>
                            {{-- Delete বাটন --}}
                            <button onclick="openDeleteModal('{{ route('admin.faqs.destroy', $faq->id) }}')" class="p-1.5 text-muted hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-muted text-sm">No FAQs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- লারাভেল ডায়নামিক পেজিনেশন লিঙ্ক --}}
    <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-between">
        <p class="text-muted text-sm">
            Showing <strong class="text-dark">{{ $faqs->firstItem() ?? 0 }}</strong> to <strong class="text-dark">{{ $faqs->lastItem() ?? 0 }}</strong> of <strong class="text-dark">{{ $faqs->total() }}</strong> FAQs
        </p>
        <div>
            {{ $faqs->appends(request()->query())->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>
</div>

{{-- Delete confirm modal (ডায়নামিক ফর্ম সহ) --}}
<div id="delete-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-2xl">
        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </div>
        <h3 class="font-heading font-bold text-dark text-lg text-center mb-2">Delete FAQ?</h3>
        <p class="text-muted text-sm text-center mb-6">This action will permanently delete this FAQ.</p>
        
        {{-- এখানে ডায়নামিকালি অ্যাকশন ইউআরএল সেট হবে JS এর মাধ্যমে --}}
        <form id="delete-faq-form" method="POST" class="flex gap-3">
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
    document.getElementById('delete-faq-form').setAttribute('action', actionUrl);
    document.getElementById('delete-modal').classList.remove('hidden');
}

function closeDelete() {
    document.getElementById('delete-modal').classList.add('hidden');
}

// টগল স্ট্যাটাস ফাংশন (AJAX কল)
function toggleStatus(actionUrl) {
    if (confirm('Are you sure you want to change the status of this FAQ?')) {
        fetch(actionUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to toggle status. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
}
</script>
@endpush
@endsection