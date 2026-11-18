<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(): View
    {
        $hardSkills = Skill::hard()->orderBy('order')->get();
        $softSkills = Skill::soft()->orderBy('order')->get();

        return view('skills.index', compact('hardSkills', 'softSkills'));
    }

    public function create(): View
    {
        return view('skills.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:hard_skill,soft_skill'],
            'level_name' => ['required', 'string', 'max:100'],
            'percentage' => ['required', 'integer', 'between:1,100'],
            'order' => ['nullable', 'integer'],
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        Skill::create($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Keahlian berhasil ditambahkan.');
    }

    public function edit(Skill $skill): View
    {
        return view('skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:hard_skill,soft_skill'],
            'level_name' => ['required', 'string', 'max:100'],
            'percentage' => ['required', 'integer', 'between:1,100'],
            'order' => ['nullable', 'integer'],
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        $skill->update($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Keahlian berhasil diperbarui.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Keahlian berhasil dihapus.');
    }
}
