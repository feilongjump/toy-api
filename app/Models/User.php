<?php

namespace App\Models;

use Carbon\Carbon;
use App\Mail\Activation;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'activated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'activated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
    ];

    protected $appends = [
        'is_activated',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function getIsActivatedAttribute(): bool
    {
        return (bool) $this->activated_at;
    }

    public function sendActiveMail()
    {
        return Mail::to($this->email)->queue(new Activation($this));
    }

    public function getActivationLink(): string
    {
        return URL::temporarySignedRoute(
            'user.activate', Carbon::now()->addMinutes(30), [ 'email' => $this->email ]
        );
    }

    public function activate(): bool
    {
        return $this->update(['activated_at' => Carbon::now()]);
    }
}
