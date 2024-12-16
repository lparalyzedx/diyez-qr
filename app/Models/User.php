<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'profile_image',
        'account_id'
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

    protected $appends = [
            'profile_img',
            'account'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeAccount($query)
    {
        if (!Auth::user()->hasRole('root')) {
        return $query->where('account_id', Auth::user()->account->id);
        }
    }

    public function owner()
    {
        return  $this->belongsTo('App\Models\Account', 'account_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\Account', 'owner_id', 'id');
    }

    public function getAccountAttribute()
    {
        return  $this->owner ?? $this->user;
    }

    public function getProfileimgAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }

        $fullname = explode(' ', $this->name);
        $photo_name = '';
        $count = count($fullname);

        if ($count > 1) {
            $photo_name = mb_substr($fullname[0], 0, 1) . mb_substr($fullname[1], 0, 1);
        } else {
            $photo_name = mb_substr($fullname[0], 0, 1);
        }

        return 'https://ui-avatars.com/api/?name=' . $photo_name . '&background=F2F2F2&color=7081B9&format=svg';
    }
}
