@extends('admin.layouts.app')
@section('title', 'Testimonials')
@section('page-title', 'Testimonials')
@section('breadcrumb', 'Admin / Testimonials')

@section('content')

<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <p class="text-muted text-sm">Manage client testimonials shown in the homepage carousel.</p>
    <button onclick="openModal()"
        class="flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-heading font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Add Testimonial
    </button>
</div>

{{-- Empty State --}}
@if($testimonials->isEmpty())
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-16 text-center">
    <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
    </svg>
    <p class="font-heading font-bold text-dark text-lg mb-2">No testimonials yet</p>
    <p class="text-muted text-sm mb-5">Add your first client testimonial to display on the homepage carousel.</p>
    <button onclick="openModal()" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-dark text-white font-heading font-semibold text-sm px-6 py-2.5 rounded-xl transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Add First Testimonial
    </button>
</div>
@else

{{-- Cards Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach($testimonials as $t)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 relative group hover:border-brand/30 hover:shadow-md transition-all">

        {{-- Action Buttons --}}
        <div class="absolute top-4 right-4 flex gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
            {{-- Active toggle --}}
            <form action="{{ route('admin.testimonials.toggle', $t->id) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit"
                    class="p-1.5 rounded-lg transition-colors {{ $t->is_active ? 'text-green-600 bg-green-50 hover:bg-green-100' : 'text-muted bg-gray-100 hover:bg-gray-200' }}"
                    title="{{ $t->is_active ? 'Click to hide' : 'Click to show' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $t->is_active ? 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z' : 'M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21' }}"/>
                    </svg>
                </button>
            </form>

            {{-- Edit --}}
            <button onclick="openModal({{ $t->toJson() }})"
                class="p-1.5 text-muted hover:text-brand hover:bg-brand/10 rounded-lg transition-colors" title="Edit">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </button>

            {{-- Delete --}}
            <button onclick="confirmDelete({{ $t->id }}, '{{ addslashes($t->name) }}')"
                class="p-1.5 text-muted hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </div>

        {{-- Status Badge --}}
        @if(!$t->is_active)
        <span class="inline-block bg-gray-100 text-gray-500 text-xs font-heading font-semibold px-2 py-0.5 rounded-full mb-3">Hidden</span>
        @endif

        {{-- Stars --}}
        <div class="flex gap-1 mb-3">
            @for($i = 1; $i <= 5; $i++)
            <svg class="w-4 h-4 {{ $i <= $t->stars ? 'text-brand' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            @endfor
        </div>

        {{-- Text --}}
        <p class="text-dark/80 text-sm leading-relaxed italic mb-4">"{{ $t->text }}"</p>

        {{-- Client Info --}}
        <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
            <div class="w-9 h-9 rounded-full bg-brand/20 flex items-center justify-center shrink-0">
                @if($t->photo)
                    <img src="{{ asset('storage/'.$t->photo) }}" class="w-9 h-9 rounded-full object-cover"/>
                @else
                    <span class="font-heading font-black text-brand text-sm">{{ strtoupper(substr($t->name, 0, 1)) }}</span>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-heading font-bold text-dark text-sm truncate">{{ $t->name }}</p>
                <p class="text-muted text-xs truncate">{{ $t->role }}</p>
            </div>
            <span class="text-xs text-muted bg-light border border-gray-100 px-2 py-1 rounded-lg shrink-0">#{{ $t->display_order }}</span>
        </div>
    </div>
    @endforeach
</div>
@endif


{{-- ===== ADD / EDIT MODAL ===== --}}
<div id="testimonial-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 sticky top-0 bg-white rounded-t-2xl z-10">
            <h3 class="font-heading font-bold text-dark text-base" id="modal-title">Add Testimonial</h3>
            <button onclick="closeModal()" class="text-muted hover:text-dark transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="testimonial-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">
            <input type="hidden" name="testimonial_id" id="testimonial-id">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">
                        Client Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="t-name" required placeholder="Md. Rafiqul Islam"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20"/>
                </div>
                <div>
                    <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">
                        Role / Company <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="role" id="t-role" required placeholder="CEO, RFL Group"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20"/>
                </div>
            </div>

            <div>
                <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">
                    Testimonial Text <span class="text-red-500">*</span>
                </label>
                <textarea name="text" id="t-text" rows="4" required
                    placeholder="Write the client's testimonial here..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20 resize-none"></textarea>
                <p class="text-muted text-xs mt-1" id="char-count">0 / 300 characters</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Star Rating</label>
                    <div class="flex gap-1.5 mt-1" id="star-picker">
                        @for($s = 1; $s <= 5; $s++)
                        <button type="button" onclick="setStars({{ $s }})" data-star="{{ $s }}"
                            class="star-btn w-9 h-9 rounded-lg border border-gray-200 flex items-center justify-center transition-all hover:border-brand">
                            <svg class="w-5 h-5 text-gray-300 star-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </button>
                        @endfor
                    </div>
                    <input type="hidden" name="stars" id="t-stars" value="5">
                </div>

                <div>
                    <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Display Order</label>
                    <input type="number" name="display_order" id="t-order" min="1" max="99" placeholder="1"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm text-dark focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20"/>
                </div>
            </div>

            <div>
                <label class="block text-xs font-heading font-semibold text-muted uppercase tracking-wider mb-1.5">Client Photo (Optional)</label>
                <div class="flex items-center gap-3">
                    <div id="photo-preview-wrap" class="w-12 h-12 rounded-full bg-brand/10 flex items-center justify-center overflow-hidden shrink-0">
                        <span id="photo-initial" class="font-heading font-black text-brand text-lg">?</span>
                        <img id="photo-preview" class="w-12 h-12 object-cover hidden rounded-full"/>
                    </div>
                    <label class="flex-1 cursor-pointer border-2 border-dashed border-gray-200 hover:border-brand rounded-xl px-4 py-3 text-center transition-colors">
                        <span class="text-muted text-xs">Click to upload photo</span>
                        <input type="file" name="photo" id="t-photo" accept="image/*" class="hidden" onchange="previewPhoto(this)"/>
                    </label>
                </div>
            </div>

            <div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" id="t-active" value="1" checked
                        class="w-4 h-4 rounded accent-brand"/>
                    <span class="text-sm text-dark font-medium">Show on website</span>
                    <span class="text-muted text-xs">(visible in homepage carousel)</span>
                </label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal()"
                    class="flex-1 border border-gray-200 text-dark text-sm font-semibold py-3 rounded-xl hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button type="submit" id="submit-btn"
                    class="flex-1 bg-brand hover:bg-brand-dark text-white text-sm font-heading font-bold py-3 rounded-xl transition-colors flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span id="submit-text">Save Testimonial</span>
                </button>
            </div>
        </form>
    </div>
</div>


{{-- ===== DELETE CONFIRM MODAL ===== --}}
<div id="delete-modal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-sm w-full shadow-2xl p-6 text-center">
        <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </div>
        <h3 class="font-heading font-black text-dark text-xl mb-2">Delete Testimonial?</h3>
        <p class="text-muted text-sm mb-1">You are about to delete the testimonial from:</p>
        <p class="font-heading font-bold text-dark text-base mb-5" id="delete-name">—</p>
        <p class="text-muted text-xs mb-6">This action cannot be undone.</p>
        <div class="flex gap-3">
            <button onclick="closeDelete()" class="flex-1 border border-gray-200 text-dark font-semibold text-sm py-3 rounded-xl hover:bg-gray-50 transition-colors">
                Cancel
            </button>
            <form id="delete-form" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold text-sm py-3 px-6 rounded-xl transition-colors">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
</div>


@push('scripts')
<script>
const ROUTES = {
    store:  '{{ route('admin.testimonials.store') }}',
    update: (id) => `/testimonials/${id}`,
};

let currentStars = 5;

// ---- Open Modal ----
function openModal(data = null) {
    const form   = document.getElementById('testimonial-form');
    const method = document.getElementById('form-method');
    const idInput = document.getElementById('testimonial-id');

    // Reset form
    form.reset();
    setStars(5);
    document.getElementById('photo-preview').classList.add('hidden');
    document.getElementById('photo-initial').classList.remove('hidden');
    document.getElementById('photo-initial').textContent = '?';

    if (data) {
        // Edit mode
        document.getElementById('modal-title').textContent = 'Edit Testimonial';
        document.getElementById('submit-text').textContent = 'Update Testimonial';
        method.value = 'PUT';
        idInput.value = data.id;
        form.action = ROUTES.update(data.id);

        document.getElementById('t-name').value    = data.name    || '';
        document.getElementById('t-role').value    = data.role    || '';
        document.getElementById('t-text').value    = data.text    || '';
        document.getElementById('t-order').value   = data.display_order || '';
        document.getElementById('t-active').checked = data.is_active == 1 || data.is_active === true;

        updateCharCount(data.text || '');
        setStars(parseInt(data.stars) || 5);

        if (data.photo) {
            document.getElementById('photo-preview').src = '/storage/' + data.photo;
            document.getElementById('photo-preview').classList.remove('hidden');
            document.getElementById('photo-initial').classList.add('hidden');
        } else {
            document.getElementById('photo-initial').textContent = data.name.charAt(0).toUpperCase();
        }
    } else {
        // Create mode
        document.getElementById('modal-title').textContent = 'Add Testimonial';
        document.getElementById('submit-text').textContent = 'Save Testimonial';
        method.value = 'POST';
        idInput.value = '';
        form.action = ROUTES.store;
    }

    document.getElementById('testimonial-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('testimonial-modal').classList.add('hidden');
    document.body.style.overflow = '';
}

// ---- Stars ----
function setStars(n) {
    currentStars = n;
    document.getElementById('t-stars').value = n;
    document.querySelectorAll('.star-btn').forEach((btn, i) => {
        const icon = btn.querySelector('.star-icon');
        if (i < n) {
            icon.classList.remove('text-gray-300');
            icon.classList.add('text-brand');
            btn.classList.add('border-brand', 'bg-brand/5');
            btn.classList.remove('border-gray-200');
        } else {
            icon.classList.add('text-gray-300');
            icon.classList.remove('text-brand');
            btn.classList.remove('border-brand', 'bg-brand/5');
            btn.classList.add('border-gray-200');
        }
    });
}
// Init stars on load
setStars(5);

// ---- Char count ----
document.getElementById('t-text').addEventListener('input', function() {
    updateCharCount(this.value);
});
function updateCharCount(text) {
    const el = document.getElementById('char-count');
    const len = text.length;
    el.textContent = `${len} / 300 characters`;
    el.className = 'text-xs mt-1 ' + (len > 280 ? 'text-red-500' : 'text-muted');
}

// ---- Photo preview ----
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('photo-preview').src = e.target.result;
            document.getElementById('photo-preview').classList.remove('hidden');
            document.getElementById('photo-initial').classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Auto-fill photo initial from name
document.getElementById('t-name').addEventListener('input', function() {
    const initial = document.getElementById('photo-initial');
    if (!document.getElementById('photo-preview').src) {
        initial.textContent = this.value.charAt(0).toUpperCase() || '?';
    }
});

// ---- Delete ----
function confirmDelete(id, name) {
    document.getElementById('delete-name').textContent = name;
    document.getElementById('delete-form').action = `/testimonials/${id}`;
    document.getElementById('delete-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeDelete() {
    document.getElementById('delete-modal').classList.add('hidden');
    document.body.style.overflow = '';
}

// Close on outside click
['testimonial-modal','delete-modal'].forEach(id => {
    document.getElementById(id).addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            document.body.style.overflow = '';
        }
    });
});
</script>
@endpush
@endsection
