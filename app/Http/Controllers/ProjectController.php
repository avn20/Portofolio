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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
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

    public function login(): View
    {
        return view('projects.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'password' => ['required', 'string', 'max:100'],
        ]);

        $throttleKey = 'admin-login:'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            throw ValidationException::withMessages([
                'password' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        if (! $this->adminPasswordMatches($validated['password'])) {
            RateLimiter::hit($throttleKey, 60);

            throw ValidationException::withMessages([
                'password' => 'Password admin salah.',
            ]);
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();
        $request->session()->put('is_admin', true);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('is_admin');

        return redirect()->route('home');
    }

    private function adminPasswordMatches(string $password): bool
    {
        $passwordHash = config('app.admin_password_hash') ?: env('ADMIN_PASSWORD_HASH');

        if ($passwordHash) {
            return Hash::check($password, $passwordHash);
        }

        $expectedPassword = (string) (config('app.admin_password') ?: env('ADMIN_PASSWORD') ?: 'admin123');

        return hash_equals($expectedPassword, $password);
    }

    public function adminIndex(): View
    {
        $projects = Project::latest()->get();

        return view('projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'problem_statement' => ['nullable', 'string'],
            'project_objective' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string', 'max:500'],
            'role' => ['nullable', 'string', 'max:255'],
            'features' => ['nullable', 'string'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'process_flow' => ['nullable', 'string'],
            'user_feedback' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'link' => ['nullable', 'url', 'max:255'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        } else {
            $validated['image'] = null;
        }

        if (empty($validated['category'])) {
            $validated['category'] = 'Web Application';
        }
        if (empty($validated['role'])) {
            $validated['role'] = 'Fullstack Developer';
        }
        if (empty($validated['demo_url']) && !empty($validated['link'])) {
            $validated['demo_url'] = $validated['link'];
        }
        if (empty($validated['link']) && !empty($validated['demo_url'])) {
            $validated['link'] = $validated['demo_url'];
        }

        Project::create($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function edit(Project $project): View
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'problem_statement' => ['nullable', 'string'],
            'project_objective' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string', 'max:500'],
            'role' => ['nullable', 'string', 'max:255'],
            'features' => ['nullable', 'string'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'process_flow' => ['nullable', 'string'],
            'user_feedback' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],
            'link' => ['nullable', 'url', 'max:255'],
        ]);

        if ($request->boolean('remove_image')) {
            if ($project->image && !str_starts_with($project->image, 'assets/')) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($project->image && !str_starts_with($project->image, 'assets/')) {
                Storage::disk('public')->delete($project->image);
            }

            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        if (empty($validated['demo_url']) && !empty($validated['link'])) {
            $validated['demo_url'] = $validated['link'];
        }
        if (empty($validated['link']) && !empty($validated['demo_url'])) {
            $validated['link'] = $validated['demo_url'];
        }

        $project->update($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        if ($project->image && !str_starts_with($project->image, 'assets/')) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }
}
