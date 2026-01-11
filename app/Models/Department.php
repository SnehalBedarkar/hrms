<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Department extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'is_active', 'sort_order',
    ];

    protected static function booted(): void
    {
        static::creating(function ($department) {
            if (empty($department->slug)) {
                $department->slug = Str::slug($department->name);
            }
        });

        static::updating(function ($department) {
            if ($department->isDirty('name')) {
                $department->slug = Str::slug($department->name);
            }
        });
    }

    public function designations()
    {
        return $this->hasMany(Designation::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
