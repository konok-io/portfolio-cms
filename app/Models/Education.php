<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'institute_name',
        'degree',
        'start_year',
        'end_year',
        'description',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('start_year');
    }

    public function getDurationAttribute(): string
    {
        $end = $this->end_year ?: 'Present';
        return "{$this->start_year} - {$end}";
    }
}
