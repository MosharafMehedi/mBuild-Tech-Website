<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('home'))->name('home');

// About Us
Route::get('/about', fn() => view('about.index'))->name('about');

// Projects
Route::get('/projects', fn() => view('projects.index'))->name('projects.index');
Route::get('/projects/{slug}', fn($slug) => view('projects.show', compact('slug')))->name('projects.show');

// Blog
Route::get('/blog', fn() => view('blog.index'))->name('blog.index');
Route::get('/blog/{slug}', fn($slug) => view('blog.show', compact('slug')))->name('blog.show');

// Contact
Route::get('/contact', fn() => view('contact.index'))->name('contact');
Route::post('/contact', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'name'         => 'required|string|max:255',
        'email'        => 'required|email',
        'phone'        => 'nullable|string|max:20',
        'inquiry_type' => 'required|string',
        'message'      => 'required|string|max:3000',
    ]);

    // TODO: Send email to CRM
    // Mail::to('info@mbuildtech.com.bd')->send(new \App\Mail\ContactMail($request->all()));

    return back()->with('success', 'Thank you! Your message has been received. Our team will contact you within 24 hours.');
})->name('contact.submit');

Route::get('/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

// প্রোজেক্টের সব CRUD রাউট (index, create, store, edit, update, destroy) এক লাইনে
Route::resource('admin/projects', ProjectController::class)->names([
    'index'   => 'admin.projects.index',
    'create'  => 'admin.projects.create',
    'store'   => 'admin.projects.store',
    'edit'    => 'admin.projects.edit',
    'update'  => 'admin.projects.update',
    'destroy' => 'admin.projects.destroy',
]);

// ফ্রন্টএন্ডে সিঙ্গেল প্রোজেক্ট ভিউ করার জন্য এই রাউটটি (যা index.blade এ view on site বাটনে ব্যবহার করা হয়েছে)
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');
