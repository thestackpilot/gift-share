<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'city',
        'weight',
        'dimensions',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class)->orderBy('order');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function getVoteScoreAttribute(): int
    {
        return $this->votes()->sum('value');
    }

    public function getUserVoteAttribute(): ?int
    {
        if (!auth()->check()) return null;
        
        $vote = $this->votes()->where('user_id', auth()->id())->first();
        return $vote?->value;
    }

    public function getPrimaryPhotoAttribute(): ?Photo
    {
        return $this->photos->first();
    }

    public function isGifted(): bool
    {
        return $this->status === 'gifted';
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeGifted($query)
    {
        return $query->where('status', 'gifted');
    }

    public function scopeSearch($query, ?string $search)
    {
        if (!$search) return $query;
        
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    public function scopeFilterByCategory($query, ?int $categoryId)
    {
        if (!$categoryId) return $query;
        return $query->where('category_id', $categoryId);
    }

    public function scopeFilterByCity($query, ?string $city)
    {
        if (!$city) return $query;
        return $query->where('city', $city);
    }

    public function scopeFilterByStatus($query, ?string $status)
    {
        if (!$status) return $query;
        return $query->where('status', $status);
    }
}
