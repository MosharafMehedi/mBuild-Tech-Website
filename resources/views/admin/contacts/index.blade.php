@extends('admin.layouts.app')
@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')
@section('breadcrumb', 'Admin / Contacts')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <div class="flex gap-2">
        @foreach(['All', 'Unread', 'Read'] as $f)
        @php $slugStatus = strtolower($f); @endphp
        <a href="{{ route('admin.contacts.index', ['status' => $slugStatus !== 'all' ? $slugStatus : null]) }}" 
           class="px-3.5 py-1.5 rounded-lg text-xs font-heading font-semibold transition-all
            {{ (request('status', 'all') === $slugStatus) ? 'bg-brand text-white' : 'bg-white border border-gray-200 text-muted hover:border-brand hover:text-dark' }}">
            {{ $f }}
        </a>
        @endforeach
    </div>
</div>

@if(session('success'))
<div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <form action="{{ route('admin.contacts.index') }}" method="GET" class="px-5 py-4 border-b border-gray-100 flex flex-wrap items-center gap-3">
        @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        
        <div class="relative flex-1 min-w-[200px] max-w-xs">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..." class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand"/>
        </div>
        
        <select name="inquiry_type" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand bg-white">
            <option value="">All Types</option>
            <option value="general" {{ request('inquiry_type') === 'general' ? 'selected' : '' }}>General</option>
            <option value="project" {{ request('inquiry_type') === 'project' ? 'selected' : '' }}>Project</option>
            <option value="booking" {{ request('inquiry_type') === 'booking' ? 'selected' : '' }}>Booking</option>
            <option value="support" {{ request('inquiry_type') === 'support' ? 'selected' : '' }}>Support</option>
        </select>

        <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-dark text-sm px-4 py-2 rounded-lg transition-colors font-medium">Filter</button>
        @if(request()->anyFilled(['search', 'inquiry_type', 'status']))
            <a href="{{ route('admin.contacts.index') }}" class="text-xs text-red-500 hover:underline">Clear Filters</a>
        @endif
    </form>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-light">
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 w-1"></th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3">Name</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden md:table-cell">Email</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden lg:table-cell">Inquiry Type</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3">Status</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden xl:table-cell">Date</th>
                    <th class="px-5 py-3 text-right text-xs font-heading font-semibold text-muted uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($contacts as $contact)
                <tr class="hover:bg-gray-50 transition-colors {{ !$contact->read_at ? 'bg-blue-50/50' : '' }}">
                    <td class="px-5 py-3.5">
                        @if(!$contact->read_at)
                            <div class="w-2.5 h-2.5 bg-brand rounded-full animate-pulse"></div>
                        @else
                            <div class="w-2.5 h-2.5 bg-gray-300 rounded-full"></div>
                        @endif
                    </td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-brand-light rounded-full flex items-center justify-center shrink-0 text-brand text-xs font-bold">
                                {{ substr($contact->name, 0, 2) }}
                            </div>
                            <span class="font-medium text-dark text-sm leading-snug">{{ $contact->name }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 hidden md:table-cell text-muted text-sm">
                        <a href="mailto:{{ $contact->email }}" class="hover:text-brand transition-colors">{{ $contact->email }}</a>
                    </td>
                    <td class="px-5 py-3.5 hidden lg:table-cell">
                        <span class="px-2.5 py-1 rounded-full text-xs font-heading font-semibold capitalize 
                            {{ $contact->inquiry_type === 'general' ? 'bg-gray-100 text-gray-600' : 
                               ($contact->inquiry_type === 'project' ? 'bg-purple-50 text-purple-700' : 
                               ($contact->inquiry_type === 'booking' ? 'bg-green-50 text-green-700' : 
                               'bg-orange-50 text-orange-700')) }}">
                            {{ $contact->inquiry_type }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5">
                        <span class="px-2.5 py-1 rounded-full text-xs font-heading font-semibold capitalize 
                            {{ $contact->read_at ? 'bg-gray-100 text-gray-600' : 'bg-brand text-white' }}">
                            {{ $contact->read_at ? 'Read' : 'Unread' }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 hidden xl:table-cell text-muted text-sm">
                        {{ $contact->created_at ? \Carbon\Carbon::parse($contact->created_at)->format('M d, Y h:i A') : 'N/A' }}
                    </td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center justify-end gap-2">
                            {{-- View বাটন --}}
                            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="p-1.5 text-muted hover:text-brand hover:bg-brand-light rounded-lg transition-colors" title="View Message">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            {{-- Delete বাটন --}}
                            <button onclick="openDeleteModal('{{ route('admin.contacts.destroy', $contact->id) }}')" class="p-1.5 text-muted hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-10 text-muted text-sm">No contact messages found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-between">
        <p class="text-muted text-sm">
            Showing <strong class="text-dark">{{ $contacts->firstItem() ?? 0 }}</strong> to <strong class="text-dark">{{ $contacts->lastItem() ?? 0 }}</strong> of <strong class="text-dark">{{ $contacts->total() }}</strong> messages
        </p>
        <div>
            {{ $contacts->appends(request()->query())->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>
</div>

<div id="delete-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-2xl">
        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </div>
        <h3 class="font-heading font-bold text-dark text-lg text-center mb-2">Delete Message?</h3>
        <p class="text-muted text-sm text-center mb-6">This action will permanently delete this contact message.</p>
        
        <form id="delete-contact-form" method="POST" class="flex gap-3">
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
    document.getElementById('delete-contact-form').setAttribute('action', actionUrl);
    document.getElementById('delete-modal').classList.remove('hidden');
}

function closeDelete() {
    document.getElementById('delete-modal').classList.add('hidden');
}

</script>
@endpush
@endsection