<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;  // 接口
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait; // Trait
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,MustVerifyEmailTrait;

    /**
     * 获取可在当前站点访问的头像 URL。
     * 兼容数据库中以前保存的 http://localhost/... 绝对地址。
     */
    public function getAvatarUrlAttribute(): ?string
    {
        $avatar = $this->attributes['avatar'] ?? null;

        if (!$avatar) {
            return null;
        }

        if (preg_match('/^https?:\/\//i', $avatar)) {
            $path = parse_url($avatar, PHP_URL_PATH);

            if (is_string($path) && str_starts_with($path, '/uploads/images/avatars/')) {
                $avatar = ltrim($path, '/');
            } else {
                return $avatar;
            }
        }

        return asset(ltrim($avatar, '/'));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'introduction',
        'avatar'
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
    ];

    public function topics(){
        return $this->hasMany(Topic::class);
    }
}
