<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $appends = [
        'image_url',
        'tech_list',
        'feature_list',
    ];

    protected $fillable = [
        'title',
        'category',
        'description',
        'problem_statement',
        'project_objective',
        'tech_stack',
        'role',
        'features',
        'demo_url',
        'github_url',
        'process_flow',
        'user_feedback',
        'image',
        'link',
    ];

    public function getTechListAttribute(): array
    {
        if (empty($this->tech_stack)) {
            return [];
        }

        return array_map('trim', explode(',', $this->tech_stack));
    }

    public function getFeatureListAttribute(): array
    {
        if (empty($this->features)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $this->features))));
    }

    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->image)) {
            return null;
        }

        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        $cleanPath = ltrim($this->image, '/');

        if (str_starts_with($cleanPath, 'assets/') || str_starts_with($cleanPath, 'storage/')) {
            return asset($cleanPath);
        }

        if (file_exists(public_path($cleanPath))) {
            return asset($cleanPath);
        }

        return asset('storage/' . $cleanPath);
    }
}
