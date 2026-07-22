<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'name',
        'email',
        'phone',
        'company',
        'budget',
        'message',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function getBudgetLabelAttribute()
    {
        return match($this->budget) {
            'under_1k' => 'Under $1,000',
            '1k_5k' => '$1,000 - $5,000',
            '5k_10k' => '$5,000 - $10,000',
            '10k_plus' => '$10,000+',
            'not_sure' => 'Not Sure',
            default => 'Not Specified',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Pending',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            default => 'Unknown',
        };
    }
}
