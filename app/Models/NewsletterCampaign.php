<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsletterCampaign extends Model
{
    use HasFactory;

    protected $table = 'newsletter_campaigns';

    protected $fillable = [
        'subject',
        'content',
        'status',
        'scheduled_at',
        'sent_at',
        'total_recipients',
        'successful_deliveries',
        'failed_deliveries',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    /**
     * Get campaigns ordered by created_at
     */
    public static function getAll()
    {
        return static::orderBy('created_at', 'desc')->get();
    }

    /**
     * Get drafts
     */
    public static function getDrafts()
    {
        return static::where('status', 'draft')->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get scheduled campaigns
     */
    public static function getScheduled()
    {
        return static::where('status', 'scheduled')->orderBy('scheduled_at', 'asc')->get();
    }

    /**
     * Send campaign to all subscribers
     */
    public function send(): void
    {
        $subscribers = Subscriber::where('is_active', true)
            ->whereNull('unsubscribed_at')
            ->get();

        $this->update([
            'status' => 'sending',
            'total_recipients' => $subscribers->count(),
        ]);

        foreach ($subscribers as $subscriber) {
            try {
                // In production, you would use a proper email service
                // For now, we'll just mark as sent
                $subscriber->update(['email_sent_at' => now()]);
                $this->increment('successful_deliveries');
            } catch (\Exception $e) {
                $this->increment('failed_deliveries');
            }
        }

        $this->update([
            'status' => 'sent',
            'sent_at' => now(),
        ]);
    }
}
