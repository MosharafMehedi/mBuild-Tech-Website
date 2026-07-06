<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Contact_us;
use App\Models\Faq;
use App\Models\Metric;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Create Admin User ----
        User::updateOrCreate(
            ['email' => 'admin@mbuildtech.com'],
            [
                'name'     => 'Admin User',
                'email'    => 'admin@mbuildtech.com',
                'password' => Hash::make('Admin@12345'),
                'email_verified_at' => now(),
            ]
        );

        // ---- Seed Metrics ----
        Metric::truncate();
        Metric::create([
            'label' => 'Years of Excellence',
            'value' => '15',
            'suffix' => '+',
            'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
            'sort_order' => 1
        ]);
        Metric::create([
            'label' => 'Sq. Ft. Delivered',
            'value' => '4.2',
            'suffix' => 'M+',
            'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5',
            'sort_order' => 2
        ]);
        Metric::create([
            'label' => 'Active Projects',
            'value' => '21',
            'suffix' => '+',
            'icon' => 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7',
            'sort_order' => 3
        ]);
        Metric::create([
            'label' => 'Quality Certified',
            'value' => '100',
            'suffix' => '%',
            'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
            'sort_order' => 4
        ]);

        // ---- Seed Projects ----
        Project::truncate();
        Project::create([
            'name' => 'mBuild Tower Dhanmondi',
            'slug' => 'mbuild-tower-dhanmondi',
            'classification' => 'residential',
            'status' => 'ongoing',
            'description' => 'Premium residential tower in Dhanmondi with modern facilities',
            'body' => '<p>A world-class residential development featuring luxury apartments with state-of-the-art facilities.</p>',
            'location' => 'Dhanmondi, Dhaka',
            'address' => 'House 12, Road 5, Dhanmondi, Dhaka-1205',
            'plot_size' => '0.50 acres',
            'floors' => 25,
            'units' => 120,
            'size_range' => '800 - 2500 sq ft',
            'price_range' => '৳ 50L - ৳ 2Cr',
            'progress_foundation' => 85,
            'progress_casting' => 65,
            'progress_finishing' => 40,
            'visibility' => 'public',
            'is_featured' => true
        ]);
        Project::create([
            'name' => 'Terracotta Commercial Hub',
            'slug' => 'terracotta-commercial-hub',
            'classification' => 'commercial',
            'status' => 'ongoing',
            'description' => 'Modern commercial complex with retail and office spaces',
            'body' => '<p>A premium commercial development designed for businesses and enterprises.</p>',
            'location' => 'Gulshan, Dhaka',
            'address' => 'Gulshan-1, Dhaka',
            'plot_size' => '0.75 acres',
            'floors' => 15,
            'units' => 45,
            'size_range' => '1500 - 5000 sq ft',
            'price_range' => '৳ 1Cr - ৳ 10Cr',
            'progress_foundation' => 90,
            'progress_casting' => 75,
            'progress_finishing' => 50,
            'visibility' => 'public',
            'is_featured' => true
        ]);
        Project::create([
            'name' => 'Skyline Apartments Uttara',
            'slug' => 'skyline-apartments-uttara',
            'classification' => 'residential',
            'status' => 'completed',
            'description' => 'Completed residential apartments in Uttara with all amenities',
            'body' => '<p>Successfully completed project delivering 200+ satisfied families.</p>',
            'location' => 'Uttara, Dhaka',
            'address' => 'Sector 4, Uttara, Dhaka',
            'plot_size' => '0.60 acres',
            'floors' => 18,
            'units' => 150,
            'size_range' => '900 - 2200 sq ft',
            'price_range' => '৳ 45L - ৳ 1.5Cr',
            'progress_foundation' => 100,
            'progress_casting' => 100,
            'progress_finishing' => 100,
            'visibility' => 'public',
            'is_featured' => true
        ]);

        // ---- Seed Blogs ----
        Blog::truncate();
        Blog::create([
            'title' => 'The Future of Sustainable Construction',
            'slug' => 'future-sustainable-construction',
            'category' => 'Construction',
            'excerpt' => 'Explore how mBuild Tech is pioneering eco-friendly construction methods.',
            'content' => '<p>Sustainable construction is not just a trend, it\'s a necessity. We at mBuild Tech are committed to implementing green building practices in all our projects.</p>',
            'author' => 'Md. Rashid Ahmed',
            'status' => 'Published',
            'published_at' => now()->subDays(5),
            'views' => 234
        ]);
        Blog::create([
            'title' => '5 Key Factors to Consider Before Buying Property',
            'slug' => '5-factors-buying-property',
            'category' => 'Real Estate',
            'excerpt' => 'A comprehensive guide to help you make the right property investment decision.',
            'content' => '<p>Investing in real estate is a major financial decision. Here are 5 key factors you should consider...</p>',
            'author' => 'Fatima Sultana',
            'status' => 'Published',
            'published_at' => now()->subDays(10),
            'views' => 456
        ]);
        Blog::create([
            'title' => 'mBuild Tech Wins National Construction Award',
            'slug' => 'mbuild-wins-construction-award',
            'category' => 'News',
            'excerpt' => 'We are proud to announce that mBuild Tech has won the prestigious National Construction Excellence Award.',
            'content' => '<p>This achievement reflects our commitment to quality and innovation in the construction industry.</p>',
            'author' => 'Admin',
            'status' => 'Published',
            'published_at' => now()->subDays(15),
            'views' => 789
        ]);

        // ---- Seed FAQs ----
        Faq::truncate();
        Faq::create([
            'question' => 'What is the payment plan for projects?',
            'answer' => 'We offer flexible payment plans including 10% down payment, 40% during construction, and 50% on handover. Custom plans are also available.',
            'category' => 'Payment',
            'sort_order' => 1,
            'is_active' => true
        ]);
        Faq::create([
            'question' => 'What are the project completion timelines?',
            'answer' => 'Project timelines vary based on project size and scope. Typically, residential projects take 24-36 months and commercial projects take 18-30 months.',
            'category' => 'Project',
            'sort_order' => 2,
            'is_active' => true
        ]);
        Faq::create([
            'question' => 'Are all projects RAJUK approved?',
            'answer' => 'Yes, all our projects are fully RAJUK approved and comply with all municipal regulations and building codes.',
            'category' => 'Compliance',
            'sort_order' => 3,
            'is_active' => true
        ]);
        Faq::create([
            'question' => 'Do you provide after-sales service?',
            'answer' => 'Yes, we provide comprehensive after-sales service including 5-year structural warranty and regular maintenance support.',
            'category' => 'Service',
            'sort_order' => 4,
            'is_active' => true
        ]);

        // ---- Sample Contact Messages ----
        Contact_us::truncate();
        Contact_us::create([
            'name' => 'Karim Ahmed',
            'email' => 'karim@example.com',
            'phone' => '01711123456',
            'inquiry_type' => 'Buy a Property',
            'message' => 'I am interested in purchasing a residential property. Can you provide more details?',
            'status' => 'read',
            'read_at' => now()
        ]);
        Contact_us::create([
            'name' => 'Fatima Begum',
            'email' => 'fatima@example.com',
            'phone' => '01812234567',
            'inquiry_type' => 'General Inquiry',
            'message' => 'I would like to know more about your commercial projects.',
            'status' => 'unread',
            'read_at' => null
        ]);

        // ---- Sample Testimonials ----
        Testimonial::truncate();
        Testimonial::create([
                'name'          => 'Md. Rafiqul Islam',
                'role'          => 'CEO, RFL Group Bangladesh',
                'text'          => 'mBuild Tech transformed our commercial vision into reality. The structural quality and on-time delivery far exceeded our expectations.',
                'stars'         => 5,
                'display_order' => 1,
                'is_active'     => true,
            ]);
        Testimonial::create([
               'name'          => 'Tahmina Begum',
                'role'          => 'Property Owner, Gulshan',
                'text'          => 'From the first consultation to key handover, every team member was professional, transparent, and genuinely invested in our needs.',
                'stars'         => 5,
                'display_order' => 2,
                'is_active'     => true,
            ]);

    }
}