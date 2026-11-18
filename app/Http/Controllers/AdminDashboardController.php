<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'projects' => Project::count(),
            'testimonials' => Testimonial::count(),
            'pending_testimonials' => Testimonial::where('is_approved', false)->count(),
            'certificates' => Certificate::count(),
            'experiences' => Experience::count(),
            'skills' => Skill::count(),
            'blogs' => Blog::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
            'total_messages' => Message::count(),
        ];

        $recentProjects = Project::latest()->take(3)->get();
        $recentMessages = Message::latest()->take(5)->get();
        $recentTestimonials = Testimonial::latest()->take(5)->get();
        $pendingTestimonials = Testimonial::where('is_approved', false)->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'recentMessages', 'recentTestimonials', 'pendingTestimonials'));
    }
}
