<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $table = 'visitors';

    protected $fillable = [
        'ip_address',
        'browser',
        'platform',
        'device',
        'country',
        'page_url',
        'visited_date',
    ];

    protected function casts(): array
    {
        return [
            'visited_date' => 'date',
        ];
    }
}
