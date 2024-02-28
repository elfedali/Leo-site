<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Node extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'owner_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'status', // draft, published, pending, etc
        'type', // shop, restaurant, hotel, etc
        'review_status',
        'phone',
        'email',
        'website',
        'address',
        'latitude',
        'longitude',
        'open_time',
        'close_time',
        'price_from',
        'price_to',
        'currency',
        'capacity',
        'rating',
        'featured',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'owner_id' => 'integer',
    ];

    public function nodeMetas(): HasMany
    {
        return $this->hasMany(NodeMeta::class);
    }

    public function terms(): BelongsToMany
    {
        return $this->belongsToMany(Term::class, 'node_terms', 'node_id', 'term_id');
    }


    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
