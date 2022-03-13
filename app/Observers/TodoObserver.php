<?php

namespace App\Observers;

use App\Models\Todo;
use Illuminate\Support\Arr;

class TodoObserver
{
    public function creating(Todo $todo)
    {
        $todo->user_id = auth()->id() ?? 1;
    }

    public function created(Todo $todo)
    {
        $this->saveContent($todo);
    }

    public function saved(Todo $todo)
    {
        $this->saveContent($todo);
    }

    protected function saveContent($todo)
    {
        if (! empty(request()->input('content')) ) {
            $type = request()->input('type', 'markdown');

            $data = Arr::only(request()->input('content', []), $type);

            $todo->content()->updateOrCreate(['contentable_id' => $todo->id], $data);

            $todo->loadMissing('content');
        }
    }
}
