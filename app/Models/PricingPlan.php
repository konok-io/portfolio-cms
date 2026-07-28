<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    use HasFactory;

    protected $table = 'pricing_plans';

    protected $fillable = [
        'name',
        'badge',
        'description',
        'monthly_price',
        'yearly_price',
        'currency',
        'features',
        'is_highlighted',
        'button_text',
        'button_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'monthly_price' => 'decimal:2',
        'yearly_price' => 'decimal:2',
        'is_highlighted' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get features as array
     */
    public function getFeaturesArray(): array
    {
        if (empty($this->features)) {
            return [];
        }
        
        $features = json_decode($this->features, true);
        return is_array($features) ? $features : [];
    }

    /**
     * Set features from array
     */
    public function setFeaturesArray(array $features): void
    {
        $this->features = json_encode($features);
    }

    /**
     * Get active pricing plans ordered by sort_order
     */
    public static function getActive()
    {
        return static::where('is_active', true)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('id', 'ASC')
            ->get();
    }

    /**
     * Format price with currency
     */
    public function formatPrice(float $price): string
    {
        $symbol = match($this->currency) {
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'BDT' => '৳',
            'INR' => '₹',
            default => $this->currency . ' ',
        };
        
        return $symbol . number_format($price, 0);
    }
}
