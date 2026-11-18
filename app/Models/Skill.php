<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'level_name',
        'percentage',
        'order',
    ];

    public function scopeHard($query)
    {
        return $query->where('category', 'hard_skill');
    }

    public function scopeSoft($query)
    {
        return $query->where('category', 'soft_skill');
    }
}
