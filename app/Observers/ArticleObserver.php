<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Arr;

class ArticleObserver
{
    public function creating(Article $article)
    {
        $article->user_id = auth()->id() ?? 1;
    }

    public function created(Article $article)
    {
        $this->saveContent($article);
    }

    public function updated(Article $article)
    {
        $this->saveContent($article);
    }

    protected function saveContent($article)
    {
        $type = request()->input('type', 'markdown');

        $data = Arr::only(request()->input('content', []), $type);

        $article->content()->updateOrCreate(['contentable_id' => $article->id], $data);

        $article->loadMissing('content');
    }
}
