<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::orderBy('order')->latest()->get();

        return view('blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('blogs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'summary' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'tags' => ['nullable', 'string', 'max:255'],
            'read_time' => ['nullable', 'string', 'max:50'],
            'is_published' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        $validated['read_time'] = $validated['read_time'] ?? '4 menit';
        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['order'] = $validated['order'] ?? 0;

        Blog::create($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Artikel / Catatan ngoding berhasil dipublikasikan.');
    }

    public function edit(Blog $blog): View
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'summary' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'tags' => ['nullable', 'string', 'max:255'],
            'read_time' => ['nullable', 'string', 'max:50'],
            'is_published' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        if ($validated['title'] !== $blog->title) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;
            while (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $validated['slug'] = $slug;
        }

        if ($request->boolean('remove_image')) {
            if ($blog->image && !str_starts_with($blog->image, 'assets/')) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($blog->image && !str_starts_with($blog->image, 'assets/')) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');
        $validated['order'] = $validated['order'] ?? 0;

        $blog->update($validated);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Artikel / Catatan ngoding berhasil diperbarui.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        if ($blog->image && !str_starts_with($blog->image, 'assets/')) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
