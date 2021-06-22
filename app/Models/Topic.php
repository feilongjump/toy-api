<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int user_id
 */
class Topic extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'user_id', 'reply_count', 'view_count',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $topic) {
            $topic->user_id = app()->runningInConsole() ? $topic->user_id : auth()->id() ?? 1;
        });
    }
}
