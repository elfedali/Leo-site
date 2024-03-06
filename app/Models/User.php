<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'username',
        'email',

        'first_name',
        'last_name',

        'phone',
        'avatar',
        'status',

        'last_login_at',
        'last_login_ip',

        'role',

        'password',
        'bio',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_login_at' => 'datetime',
    ];

    public function nodes()
    {
        return $this->hasMany(Node::class, 'owner_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'uploader_id');
    }

    public function userMetas()
    {
        return $this->hasMany(UserMeta::class);
    }

    // on create set the uuid
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($node) {
            $node->uuid = (string) \Str::uuid();
        });
    }
}
