<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Node extends Model
{
    use HasFactory;
    use HasSlug;

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
        'type', // restaurant, hotel, etc

        'reservation_required',
        'reservation_note',

        'review_note',
        'review_status',

        'phone',
        'phone_secondary',
        'phone_tertiary',

        'email',

        'address',

        'latitude',
        'longitude',

        'open_time',
        'close_time',

        'price_from',
        'price_to',

        'recommended',
        'featured',

        'currency',
        'capacity',
        'rating',

        'website',

        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'tiktok',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'owner_id' => 'integer',
        'latitude' => 'double',
        'longitude' => 'double',
        // 'open_time' => 'time',
        // 'close_time' => 'time',
        'price_from' => 'decimal:2',
        'price_to' => 'decimal:2',
        'recommended' => 'boolean',
        'featured' => 'boolean',
        'capacity' => 'integer',
        'rating' => 'decimal:1',

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

    // slug 

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    // on create set the uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($node) {
            $node->uuid = (string) \Str::uuid();
        });
    }

    // get created at in human readable format
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->diffForHumans();
    }

    // menuCategories
    public function menuCategories(): HasMany
    {
        return $this->hasMany(MenuCategory::class)
            ->orderBy('created_at', 'desc')
            ->with('items');
    }
}
