<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $table = 'media';
    
    protected $fillable = [
        'name',
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
        'alt_text',
        'caption',
    ];
    
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }
    
    public function getSizeFormattedAttribute(): string
    {
        $bytes = $this->file_size;
        
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        
        return $bytes . ' bytes';
    }
    
    public function getTypeIconAttribute(): string
    {
        if (str_starts_with($this->mime_type, 'image/')) {
            return 'fa-solid fa-image';
        } elseif (str_starts_with($this->mime_type, 'video/')) {
            return 'fa-solid fa-video';
        } elseif (str_starts_with($this->mime_type, 'audio/')) {
            return 'fa-solid fa-headphones';
        } elseif ($this->mime_type === 'application/pdf') {
            return 'fa-solid fa-file-pdf';
        } else {
            return 'fa-solid fa-file';
        }
    }
    
    public function deleteFile(): bool
    {
        if (Storage::disk('public')->exists($this->file_path)) {
            return Storage::disk('public')->delete($this->file_path);
        }
        return false;
    }
}
