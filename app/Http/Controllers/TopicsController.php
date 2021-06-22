<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Http\Requests\TopicRequest;
use App\Http\Resources\TopicResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TopicsController extends Controller
{
    public function index(TopicRequest $request, Topic $topic): AnonymousResourceCollection
    {
        $topics = $topic->paginate();

        return TopicResource::collection($topics);
    }

    public function store(TopicRequest $request): TopicResource
    {
        return new TopicResource(Topic::create($request->all()));
    }

    public function show(Topic $topic): TopicResource
    {
        return new TopicResource($topic);
    }

    public function update(TopicRequest $request, Topic $topic): TopicResource
    {
        $this->authorize('update', $topic);

        $attributes = $request->only(['title']);

        $topic->update($attributes);

        return new TopicResource($topic);
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);

        $topic->delete();

        return $this->withNoContent();
    }
}
