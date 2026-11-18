<?php

namespace App\Http\Controllers;

use App\Models\ProfileSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(): View
    {
        $settings = ProfileSetting::allKeyed();

        return view('profile.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $fields = [
            'full_name',
            'nickname',
            'class_major',
            'school_name',
            'hero_role',
            'personal_branding',
            'core_skills',
            'about_bio',
            'birth_place_date',
            'address',
            'spoken_languages',
            'interest_tech',
            'career_objective',
            'education_history',
            'plk_summary',
            'org_summary',
            'stat_projects',
            'stat_experience',
            'stat_certificates',
            'stat_satisfaction',
            'email',
            'phone',
            'whatsapp',
            'github',
            'instagram',
            'linkedin',
            'location',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                ProfileSetting::set($field, $request->input($field));
            }
        }

        if ($request->boolean('remove_avatar')) {
            $oldAvatar = ProfileSetting::get('avatar_image');
            if ($oldAvatar && !str_starts_with($oldAvatar, 'assets/')) {
                Storage::disk('public')->delete($oldAvatar);
            }
            ProfileSetting::set('avatar_image', null);
        } elseif ($request->hasFile('avatar_image')) {
            $oldAvatar = ProfileSetting::get('avatar_image');
            if ($oldAvatar && !str_starts_with($oldAvatar, 'assets/')) {
                Storage::disk('public')->delete($oldAvatar);
            }
            $path = $request->file('avatar_image')->store('profile', 'public');
            ProfileSetting::set('avatar_image', $path);
        }

        return redirect()
            ->route('admin.profile.index')
            ->with('success', 'Informasi profil dan konten website berhasil diperbarui tanpa menghapus kode!');
    }
}
