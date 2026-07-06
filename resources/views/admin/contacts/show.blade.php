@extends('admin.layouts.app')
@section('title', 'View Contact Message')
@section('page-title', 'Contact Message Details')
@section('breadcrumb', 'Admin / Contacts / View')

@section('content')
<div class="max-w-4xl mx-auto">
    
    {{-- সাকসেস অ্যালার্ট --}}
    @if(session('success'))
    <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- মেইন কন্টেইনার --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        
        {{-- ১. প্রেরকের তথ্য (Header) --}}
        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-heading font-bold text-dark">{{ $contact->name }}</h2>
                <p class="text-xs text-muted mt-0.5">Received: {{ $contact->created_at->format('M d, Y h:i A') }} ({{ $contact->created_at->diffForHumans() }})</p>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 rounded-full text-xs font-semibold capitalize bg-gray-100 text-gray-600">
                    {{ $contact->inquiry_type }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $contact->read_at ? 'bg-green-50 text-green-700' : 'bg-brand text-white' }}">
                    {{ $contact->read_at ? 'Read' : 'Unread' }}
                </span>
            </div>
        </div>

        {{-- ২. যোগাযোগের মাধ্যমসমূহ --}}
        <div class="p-6 border-b border-gray-100 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-xs text-muted block font-semibold uppercase tracking-wider">Email</span>
                <a href="mailto:{{ $contact->email }}" class="text-brand hover:underline font-medium">{{ $contact->email }}</a>
            </div>
            <div>
                <span class="text-xs text-muted block font-semibold uppercase tracking-wider">Phone</span>
                <span class="text-dark font-medium">{{ $contact->phone ?? 'N/A' }}</span>
            </div>
        </div>

        {{-- ৩. মেসেজ বডি --}}
        <div class="p-6">
            <span class="text-xs text-muted block font-semibold uppercase tracking-wider mb-2">Message</span>
            <div class="text-sm text-dark whitespace-pre-wrap leading-relaxed bg-gray-50/50 border border-gray-100 rounded-xl p-5">
                {{ $contact->message }}
            </div>
        </div>

        {{-- ৪. অ্যাকশন বাটনসমূহ --}}
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30 flex items-center justify-between gap-3">
            <button onclick="openDeleteModal('{{ route('admin.contacts.destroy', $contact->id) }}')" class="text-red-600 hover:text-red-700 text-sm font-semibold flex items-center gap-1">
                Delete
            </button>
            
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.contacts.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-dark text-sm font-medium rounded-xl transition-colors">
                    Back to List
                </a>

                @if(!$contact->read_at)
                <form action="{{ route('admin.contacts.mark-read', $contact->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-xl transition-colors">
                        Mark as Read
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Delete modal --}}
<div id="delete-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl p-6 max-w-sm w-full shadow-xl">
        <h3 class="font-bold text-dark text-lg mb-1">Delete Message?</h3>
        <p class="text-muted text-sm mb-5">Are you sure you want to delete this message?</p>
        
        <form id="delete-contact-form" method="POST" class="flex gap-3">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDelete()" class="flex-1 border border-gray-200 text-dark text-sm py-2 rounded-lg hover:bg-gray-50">Cancel</button>
            <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white text-sm py-2 rounded-lg">Delete</button>
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