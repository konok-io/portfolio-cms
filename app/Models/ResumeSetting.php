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
        'heading_color',
        'text_color',
        'background_color',
        'header_bg_color',
        'header_text_color',
        'footer_bg_color',
        'footer_text_color',
        'include_photo',
        'include_skills',
        'include_experience',
        'include_education',
        'include_projects',
        'include_certifications',
        'cv_file',
        'cv_filename',
        'use_custom_cv',
    ];

    protected $casts = [
        'include_photo' => 'boolean',
        'include_skills' => 'boolean',
        'include_experience' => 'boolean',
        'include_education' => 'boolean',
        'include_projects' => 'boolean',
        'include_certifications' => 'boolean',
        'use_custom_cv' => 'boolean',
        'heading_color' => 'string',
        'text_color' => 'string',
        'background_color' => 'string',
        'header_bg_color' => 'string',
        'header_text_color' => 'string',
        'footer_bg_color' => 'string',
        'footer_text_color' => 'string',
    ];

    /**
     * Get CV file URL
     */
    public function getCvFileUrlAttribute(): ?string
    {
        return $this->cv_file ? asset('storage/' . $this->cv_file) : null;
    }

    /**
     * Get single instance
     */
    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'template' => 'modern',
            'primary_color' => '#2563eb',
            'heading_color' => '#1a1a2e',
            'text_color' => '#4a5568',
            'background_color' => '#ffffff',
            'header_bg_color' => '#1a1a2e',
            'footer_bg_color' => '#1a1a2e',
            'include_photo' => true,
            'include_skills' => true,
            'include_experience' => true,
            'include_education' => true,
            'include_projects' => false,
            'include_certifications' => false,
        ]);
    }
}
