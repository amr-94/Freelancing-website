<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title', 'email', 'user_id',
        'des', 'company', 'website', 'tags', 'location', 'logo'
    ];

    /**
     * Get the user that owns the Listing
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the comments for the Listing
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messges(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
