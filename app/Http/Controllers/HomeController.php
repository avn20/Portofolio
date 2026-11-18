<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Message;
use App\Models\ProfileSetting;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class HomeController extends Controller
{
    public function index(): View
    {
        $projects = Project::latest()->get();
        $testimonials = Testimonial::approved()->latest()->get();
        $certificates = Certificate::orderBy('order')->latest()->get();
        $experiencesPlk = Experience::plk()->orderBy('order')->get();
        $experiencesOrg = Experience::organisasi()->orderBy('order')->get();
        $experiencesLomba = Experience::lomba()->orderBy('order')->get();
        $hardSkills = Skill::hard()->orderBy('order')->get();
        $softSkills = Skill::soft()->orderBy('order')->get();
        $blogs = Blog::published()->orderBy('order')->latest()->take(6)->get();
        $profile = ProfileSetting::allKeyed();

        return view('welcome', compact(
            'projects',
            'testimonials',
            'certificates',
            'experiencesPlk',
            'experiencesOrg',
            'experiencesLomba',
            'hardSkills',
            'softSkills',
            'blogs',
            'profile'
        ));
    }

    public function storeMessage(Request $request): RedirectResponse
    {
        $throttleKey = 'submit-message:' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return redirect()
                ->to(route('home') . '#kesan-pesan')
                ->withErrors(['message' => "Terlalu banyak pesan terkirim. Silakan tunggu {$seconds} detik lagi."]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        RateLimiter::hit($throttleKey, 120);

        Message::create($validated);

        return redirect()
            ->to(route('home') . '#kesan-pesan')
            ->with('message_submitted', 'Terima kasih banyak! Kesan dan pesan Anda telah berhasil dikirim dan tersimpan di database.');
    }

    public function showBlog(Blog $blog): View
    {
        abort_unless($blog->is_published, 404);
        $recentBlogs = Blog::published()->where('id', '!=', $blog->id)->latest()->take(3)->get();
        $profile = ProfileSetting::allKeyed();

        return view('blogs.show', compact('blog', 'recentBlogs', 'profile'));
    }

    public function showCv(): View
    {
        $profile = ProfileSetting::allKeyed();
        $hardSkills = Skill::hard()->orderBy('order')->get();
        $softSkills = Skill::soft()->orderBy('order')->get();
        $experiencesPlk = Experience::plk()->orderBy('order')->get();
        $experiencesOrg = Experience::organisasi()->orderBy('order')->get();
        $experiencesLomba = Experience::lomba()->orderBy('order')->get();
        $projects = Project::take(3)->get();
        $certificates = Certificate::orderBy('order')->take(4)->get();

        return view('cv', compact(
            'profile',
            'hardSkills',
            'softSkills',
            'experiencesPlk',
            'experiencesOrg',
            'experiencesLomba',
            'projects',
            'certificates'
        ));
    }
}
