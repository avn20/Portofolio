<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TestimonialController extends Controller
{
    public function publicStore(Request $request): RedirectResponse
    {
        $throttleKey = 'submit-testimonial:'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            throw ValidationException::withMessages([
                'content' => "Terlalu banyak pengiriman testimoni. Silakan coba lagi dalam {$seconds} detik.",
            ]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'rating' => ['nullable', 'integer', 'between:1,5'],
            'content' => ['required', 'string', 'max:1000'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        RateLimiter::hit($throttleKey, 300);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        if (empty($validated['category'])) {
            $validated['category'] = 'Teman';
        }
        if (empty($validated['rating'])) {
            $validated['rating'] = 5;
        }

        $validated['is_approved'] = false;

        Testimonial::create($validated);

        return redirect(route('home').'#testimoni')
            ->with('testimonial_submitted', __('portfolio.testimonials.submitted_success'));
    }

    public function index(Request $request): View
    {
        $status = $request->query('status', 'all');
        $category = $request->query('category', 'all');

        $query = Testimonial::query();

        if ($status === 'pending') {
            $query->where('is_approved', false);
        } elseif ($status === 'approved') {
            $query->where('is_approved', true);
        }

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $testimonials = $query->latest()->get();

        $pendingCount = Testimonial::where('is_approved', false)->count();
        $approvedCount = Testimonial::where('is_approved', true)->count();
        $allCount = Testimonial::count();

        return view('testimonials.index', compact('testimonials', 'status', 'category', 'pendingCount', 'approvedCount', 'allCount'));
    }

    public function create(): View
    {
        return view('testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'rating' => ['nullable', 'integer', 'between:1,5'],
            'content' => ['required', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_approved' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $validated['category'] = $validated['category'] ?? 'Guru Pembimbing';
        $validated['rating'] = $validated['rating'] ?? 5;
        $validated['is_approved'] = $request->boolean('is_approved', true);

        Testimonial::create($validated);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'rating' => ['nullable', 'integer', 'between:1,5'],
            'content' => ['required', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'remove_avatar' => ['nullable', 'boolean'],
            'is_approved' => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('remove_avatar')) {
            if ($testimonial->avatar && !str_starts_with($testimonial->avatar, 'assets/')) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $validated['avatar'] = null;
        } elseif ($request->hasFile('avatar')) {
            if ($testimonial->avatar && !str_starts_with($testimonial->avatar, 'assets/')) {
                Storage::disk('public')->delete($testimonial->avatar);
            }

            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $validated['is_approved'] = $request->boolean('is_approved');

        $testimonial->update($validated);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function approve(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['is_approved' => true]);

        return back()->with('success', 'Testimoni berhasil disetujui.');
    }

    public function unapprove(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['is_approved' => false]);

        return back()->with('success', 'Testimoni berhasil dipindahkan ke antrean.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        if ($testimonial->avatar && !str_starts_with($testimonial->avatar, 'assets/')) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus.');
    }
}
