<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'organization',
        'period',
        'location',
        'description',
        'skills_gained',
        'order',
    ];

    public function scopePlk($query)
    {
        return $query->where('type', 'plk');
    }

    public function scopeOrganisasi($query)
    {
        return $query->where('type', 'organisasi');
    }

    public function scopeLomba($query)
    {
        return $query->where('type', 'lomba');
    }

    public function getSkillsListAttribute(): array
    {
        if (empty($this->skills_gained)) {
            return [];
        }

        return array_map('trim', explode(',', $this->skills_gained));
    }
}
