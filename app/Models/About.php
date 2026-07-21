<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'abouts';

    protected $fillable = [
        'name',
        'title',
        'short_intro',
        'description',
        'photo',
        'cv_file',
        'hero_photo',
        'address',
        'phone',
        'email',
        'whatsapp',
        'linkedin',
        'github',
        'facebook',
        'twitter',
        'instagram',
    ];

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo && $this->exists) {
            return asset('storage/' . $this->photo);
        }
        $name = urlencode($this->name ?? 'Portfolio');
        return "https://ui-avatars.com/api/?name={$name}&size=400&background=2563EB&color=fff";
    }

    public function getHeroPhotoUrlAttribute(): ?string
    {
        if ($this->hero_photo && $this->exists) {
            return asset('storage/' . $this->hero_photo);
        }
        return null;
    }

    public function getCvUrlAttribute(): ?string
    {
        if ($this->cv_file && $this->exists) {
            return asset('storage/' . $this->cv_file);
        }
        return null;
    }
}
