<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeSetting extends Model
{
    use HasFactory;

    protected $table = 'resume_settings';

    protected $fillable = [
        'template',
        'primary_color',
        'include_photo',
        'include_skills',
        'include_experience',
        'include_education',
        'include_projects',
        'include_certifications',
    ];

    protected $casts = [
        'include_photo' => 'boolean',
        'include_skills' => 'boolean',
        'include_experience' => 'boolean',
        'include_education' => 'boolean',
        'include_projects' => 'boolean',
        'include_certifications' => 'boolean',
    ];

    /**
     * Get single instance
     */
    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'template' => 'modern',
            'primary_color' => '#2563eb',
            'include_photo' => true,
            'include_skills' => true,
            'include_experience' => true,
            'include_education' => true,
            'include_projects' => false,
            'include_certifications' => false,
        ]);
    }
}
