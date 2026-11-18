<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->query('type', 'all');
        $query = Experience::query();

        if (in_array($type, ['plk', 'organisasi', 'lomba'])) {
            $query->where('type', $type);
        }

        $experiences = $query->orderBy('order')->latest()->get();

        $plkCount = Experience::where('type', 'plk')->count();
        $orgCount = Experience::where('type', 'organisasi')->count();
        $lombaCount = Experience::where('type', 'lomba')->count();

        return view('experiences.index', compact('experiences', 'type', 'plkCount', 'orgCount', 'lombaCount'));
    }

    public function create(): View
    {
        return view('experiences.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:plk,organisasi,lomba'],
            'title' => ['required', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255'],
            'period' => ['nullable', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'skills_gained' => ['nullable', 'string', 'max:500'],
            'order' => ['nullable', 'integer'],
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        Experience::create($validated);

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Data pengalaman berhasil ditambahkan.');
    }

    public function edit(Experience $experience): View
    {
        return view('experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:plk,organisasi,lomba'],
            'title' => ['required', 'string', 'max:255'],
            'organization' => ['required', 'string', 'max:255'],
            'period' => ['nullable', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'skills_gained' => ['nullable', 'string', 'max:500'],
            'order' => ['nullable', 'integer'],
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        $experience->update($validated);

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Data pengalaman berhasil diperbarui.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Data pengalaman berhasil dihapus.');
    }
}
