<?php

namespace App\Http\Controllers;

use App\Models\Project;
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

        return view('welcome', compact('projects'));
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

        return redirect()->route('admin.projects.index');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('is_admin');

        return redirect()->route('home');
    }

    private function adminPasswordMatches(string $password): bool
    {
        $passwordHash = env('ADMIN_PASSWORD_HASH');

        if ($passwordHash) {
            return Hash::check($password, $passwordHash);
        }

        return hash_equals((string) env('ADMIN_PASSWORD', 'admin123'), $password);
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
            'description' => ['required', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'link' => ['nullable', 'url', 'max:255'],
        ]);

        $validated['image'] = $request->file('image')->store('projects', 'public');

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
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'link' => ['nullable', 'url', 'max:255'],
        ]);

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }

            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }
}
