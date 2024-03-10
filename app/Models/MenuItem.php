<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'owner_id',
        'category_id',
        'title',
        'description',
        'price',
        'currency',
        'status',
    ];


    // on create set the uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($node) {
            $node->uuid = (string) Str::uuid();
        });
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }
}
