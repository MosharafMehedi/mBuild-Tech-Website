<?php

use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MetricController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// About Us
Route::get('/about', fn() => view('about.index'))->name('about');

// Projects
Route::get('/projects', [ProjectController::class, 'allProjects'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

// Blog
Route::get('/blog', [BlogController::class, 'publicIndex'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Contact
Route::get('/contact', fn() => view('contact.index'))->name('contact');
Route::post('/contact', [ContactUsController::class, 'store'])->name('contact.submit');

    // TODO: Send email to CRM
    // Mail::to('info@mbuildtech.com.bd')->send(new \App\Mail\ContactMail($request->all()));

Route::get('/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::resource('admin/projects', ProjectController::class)->names([
    'index'   => 'admin.projects.index',
    'create'  => 'admin.projects.create',
    'store'   => 'admin.projects.store',
    'edit'    => 'admin.projects.edit',
    'update'  => 'admin.projects.update',
    'destroy' => 'admin.projects.destroy',
]);

Route::resource('admin/blogs', BlogController::class)->names([
    'index'   => 'admin.blogs.index',
    'create'  => 'admin.blogs.create',
    'store'   => 'admin.blogs.store',
    'edit'    => 'admin.blogs.edit',
    'update'  => 'admin.blogs.update',
    'destroy' => 'admin.blogs.destroy',
]);

// FAQs Admin
Route::patch('admin/faqs/{id}/toggle', [FaqController::class, 'toggle'])->name('admin.faqs.toggle');
Route::resource('admin/faqs', FaqController::class)->names([
    'index'   => 'admin.faqs.index',
    'create'  => 'admin.faqs.create',
    'store'   => 'admin.faqs.store',
    'edit'    => 'admin.faqs.edit',
    'update'  => 'admin.faqs.update',
    'destroy' => 'admin.faqs.destroy',
]);

// Metrics Admin
Route::resource('metrics', MetricController::class)->names([
    'index'   => 'admin.metrics.index',
    'create'  => 'admin.metrics.create',
    'store'   => 'admin.metrics.store',
    'edit'    => 'admin.metrics.edit',
    'update'  => 'admin.metrics.update',
    'destroy' => 'admin.metrics.destroy',
]);

// Contacts Admin
Route::resource('contacts', ContactUsController::class)->names([
    'index'   => 'admin.contacts.index',
    'show'    => 'admin.contacts.show',
    'destroy' => 'admin.contacts.destroy',
]);
Route::post('/contacts/{id}/mark-read', [ContactUsController::class, 'markRead'])->name('admin.contacts.mark-read');

//Testimonials Admin
    Route::get('/testimonials',                          [TestimonialController::class, 'index'])->name('admin.testimonials.index');
    Route::post('/testimonials',                         [TestimonialController::class, 'store'])->name('admin.testimonials.store');
    Route::put('/testimonials/{testimonial}',            [TestimonialController::class, 'update'])->name('admin.testimonials.update');
    Route::patch('/testimonials/{testimonial}/toggle',   [TestimonialController::class, 'toggle'])->name('admin.testimonials.toggle');
    Route::delete('/testimonials/{testimonial}',         [TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');