@extends('admin.layouts.app')
@section('title', 'Blogs')
@section('page-title', 'Blogs')
@section('breadcrumb', 'Admin / Blogs')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <div class="flex gap-2">
        {{-- স্ট্যাটাস ফিল্টারিং লিংক --}}
        @foreach(['All', 'Published', 'Draft'] as $f)
        @php $slugStatus = strtolower($f); @endphp
        <a href="{{ route('admin.blogs.index', ['status' => $slugStatus !== 'all' ? $slugStatus : null]) }}" 
           class="px-3.5 py-1.5 rounded-lg text-xs font-heading font-semibold transition-all
            {{ (request('status', 'all') === $slugStatus) ? 'bg-brand text-white' : 'bg-white border border-gray-200 text-muted hover:border-brand hover:text-dark' }}">
            {{ $f }}
        </a>
        @endforeach
    </div>
    
    {{-- Add New Blog বাটন --}}
    <a href="{{ route('admin.blogs.create') }}" class="flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-heading font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Add New Blog
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
    <form action="{{ route('admin.blogs.index') }}" method="GET" class="px-5 py-4 border-b border-gray-100 flex flex-wrap items-center gap-3">
        @if(request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        
        <div class="relative flex-1 min-w-[200px] max-w-xs">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search blogs..." class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand"/>
        </div>
        
        <select name="category" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-dark focus:outline-none focus:border-brand bg-white">
            <option value="">All Categories</option>
            <option value="real-estate" {{ request('category') === 'real-estate' ? 'selected' : '' }}>Real Estate</option>
            <option value="construction" {{ request('category') === 'construction' ? 'selected' : '' }}>Construction</option>
            <option value="architecture" {{ request('category') === 'architecture' ? 'selected' : '' }}>Architecture</option>
            <option value="design" {{ request('category') === 'design' ? 'selected' : '' }}>Design</option>
        </select>

        <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-dark text-sm px-4 py-2 rounded-lg transition-colors font-medium">Filter</button>
        @if(request()->anyFilled(['search', 'category', 'status']))
            <a href="{{ route('admin.blogs.index') }}" class="text-xs text-red-500 hover:underline">Clear Filters</a>
        @endif
    </form>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-light">
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3">Blog Post</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden md:table-cell">Category</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden lg:table-cell">Author</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3">Status</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden xl:table-cell">Views</th>
                    <th class="text-left text-xs font-heading font-semibold text-muted uppercase tracking-wider px-5 py-3 hidden lg:table-cell">Published Date</th>
                    <th class="px-5 py-3 text-right text-xs font-heading font-semibold text-muted uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                {{-- ডাটাবেজ থেকে আসা ব্লগ লুপ --}}
                @forelse($blogs as $blog)
                <tr>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-3">
                            @if($blog->featured_image)
                                <img src="{{ asset('storage/' . $blog->featured_image) }}" class="w-10 h-10 rounded-lg object-cover shrink-0"/>
                            @else
                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center shrink-0 text-gray-400 text-xs font-bold">No Img</div>
                            @endif
                            <span class="font-medium text-dark text-sm leading-snug max-w-[180px]">{{ $blog->title }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5 hidden md:table-cell text-muted text-sm capitalize">{{ $blog->category }}</td>
                    <td class="px-5 py-3.5 hidden lg:table-cell text-muted text-sm">{{ $blog->author }}</td>
                    <td class="px-5 py-3.5">
                        <span class="px-2.5 py-1 rounded-full text-xs font-heading font-semibold capitalize 
                            {{ $blog->status === 'published' ? 'bg-green-50 text-green-700' : 'bg-yellow-50 text-yellow-700' }}">
                            {{ $blog->status }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 hidden xl:table-cell text-muted text-sm">{{ $blog->views ?? 0 }}</td>
                    <td class="px-5 py-3.5 hidden lg:table-cell text-muted text-sm">
                        {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') : 'N/A' }}
                    </td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center justify-end gap-2">
                            {{-- Edit বাটন --}}
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="p-1.5 text-muted hover:text-brand hover:bg-brand-light rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            {{-- Front Site View বাটন --}}
                            <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="p-1.5 text-muted hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="View on site">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            {{-- Delete বাটন --}}
                            <button onclick="openDeleteModal('{{ route('admin.blogs.destroy', $blog->id) }}')" class="p-1.5 text-muted hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-10 text-muted text-sm">No blog posts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- লারাভেল ডায়নামিক পেজিনেশন লিঙ্ক --}}
    <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-between">
        <p class="text-muted text-sm">
            Showing <strong class="text-dark">{{ $blogs->firstItem() ?? 0 }}</strong> to <strong class="text-dark">{{ $blogs->lastItem() ?? 0 }}</strong> of <strong class="text-dark">{{ $blogs->total() }}</strong> blog posts
        </p>
        <div>
            {{ $blogs->appends(request()->query())->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>
</div>

{{-- Delete confirm modal (ডায়নামিক ফর্ম সহ) --}}
<div id="delete-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-2xl">
        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </div>
        <h3 class="font-heading font-bold text-dark text-lg text-center mb-2">Delete Blog Post?</h3>
        <p class="text-muted text-sm text-center mb-6">This action will permanently delete this blog post.</p>
        
        {{-- এখানে ডায়নামিকালি অ্যাকশন ইউআরএল সেট হবে JS এর মাধ্যমে --}}
        <form id="delete-blog-form" method="POST" class="flex gap-3">
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
    document.getElementById('delete-blog-form').setAttribute('action', actionUrl);
    document.getElementById('delete-modal').classList.remove('hidden');
}

function closeDelete() {
    document.getElementById('delete-modal').classList.add('hidden');
}
</script>
@endpush
@endsection