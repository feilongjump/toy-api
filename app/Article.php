<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title'
    ];

    protected static function boot()
    {
        parent::boot();

        $saveContent = function (self $article) {
            $data['markdown'] = request()->markdown;

            $article->content()->updateOrCreate(['article_id' => $article->id], $data);
        };

        self::created($saveContent);
        self::saved($saveContent);

        self::deleted(function (self $article) {
            $article->content()->delete();
        });
    }

    /**
     * 为数组 / JSON 序列化准备日期。
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }

    public function content()
    {
        return $this->hasOne(Content::class);
    }
}
