<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $table = 'statistics';

    protected $fillable = [
        'title',
        'icon',
        'value',
        'suffix',
        'prefix',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'value' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get active statistics
     */
    public static function getActive()
    {
        return static::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    }

    /**
     * Format value with prefix and suffix
     */
    public function getFormattedValue(): string
    {
        $value = number_format($this->value);
        
        if ($this->prefix) {
            $value = $this->prefix . $value;
        }
        
        if ($this->suffix) {
            $value = $value . $this->suffix;
        }
        
        return $value;
    }
}
