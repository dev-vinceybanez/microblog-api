<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "body",
        "image",
        "user_id"
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch(Builder $query, $search): void {
        $query->where("body", "LIKE", "%$search%");
    }
}
