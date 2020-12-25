<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index(TodoRequest $request, Todo $todo)
    {
        $query = $todo->query();

        if (! empty($request->user()->id)) $query->whereUserId($request->user()->id);

        $todos = $query->paginate($request->get('limit', 20));

        return TodoResource::collection($todos);
    }

    public function store(TodoRequest $request)
    {
        $request->offsetSet('user_id', $request->user()->id);

        return new TodoResource(Todo::create($request->all()));
    }

    public function show(Todo $todo)
    {
        return new TodoResource($todo);
    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update($request->all());

        return new TodoResource($todo);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->noContent();
    }
}
