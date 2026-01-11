<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Designation extends Model
{
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public static function booted(): void
    {
        static::creating(function ($designation) {
            $designation->slug = Str::slug($designation->name);
        });

        static::updating(function ($designation) {
            if ($designation->isDirty('name')) {
                $designation->slug = Str::slug($designation->name);
            }
        });
    }
}
