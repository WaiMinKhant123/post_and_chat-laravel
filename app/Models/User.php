<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'is_admin',
        'banned',
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function isBanned()
    {
        return $this->banned;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    public function isFollowing(User $user): bool
    {
        return $this->following()->where('followed_id', $user->id)->exists();
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function blockedUsers(): HasMany
    {
        return $this->hasMany(Block::class, 'user_id');
    }

    public function isBlocked($userId): bool
    {
        return $this->blockedUsers()->where('blocked_user_id', $userId)->exists();
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class, 'user_id');
    }

    public function isUserBlocked($userId): bool
    {
        return $this->blocks()->where('blocked_user_id', $userId)->exists();
    }
}
