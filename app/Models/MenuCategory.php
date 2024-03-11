<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class MenuCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'owner_id',
        'title',
        'status', # published, draft
        'node_id'
    ];

    // protected $casts = [
    //     'status' => 'string',
    //     'title' => 'string',
    //     'uuid' => 'string',
    //     'owner_id' => 'integer',
    //     'node_id' => 'integer'
    // ];


    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function node(): BelongsTo
    {
        return $this->belongsTo(Node::class, 'node_id');
    }

    // on create set the uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($node) {
            $node->uuid = (string) \Str::uuid();
        });
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class, 'category_id');
    }
}
