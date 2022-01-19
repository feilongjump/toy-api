<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Response;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $todos = Todo::whereUserId(auth('api')->user()->id)->latest()->get();

        return TodoResource::collection($todos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TodoRequest $request
     * @return TodoResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(TodoRequest $request)
    {
        $this->authorize('create', Todo::class);

        return new TodoResource(Todo::create($request->except('status')));
    }

    /**
     * Display the specified resource.
     *
     * @param Todo $todo
     * @return TodoResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Todo $todo)
    {
        $this->authorize('view', $todo);

        $todo->loadMissing('content');

        return new TodoResource($todo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TodoRequest $request
     * @param Todo $todo
     * @return TodoResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TodoRequest $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        $todo->title = $request->title;
        $todo->save();

        return new TodoResource($todo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo $todo
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);

        $todo->delete();
        $todo->content()->delete();

        return $this->withNoContent();
    }

    public function processing(Todo $todo)
    {
        $this->authorize('update', $todo);

        $todo->status = 'processing';
        $todo->save();

        return new TodoResource($todo);
    }

    public function success(Todo $todo)
    {
        $this->authorize('update', $todo);

        $todo->status = 'success';
        $todo->save();

        return new TodoResource($todo);
    }

    public function failed(Todo $todo)
    {
        $this->authorize('update', $todo);

        $todo->status = 'failed';
        $todo->save();

        return new TodoResource($todo);
    }
}
