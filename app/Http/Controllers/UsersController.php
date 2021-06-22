<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UsersController extends Controller
{
    public function index(UserRequest $request, User $user): AnonymousResourceCollection
    {
        $topics = $user->paginate();

        return UserResource::collection($topics);
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    public function me(UserRequest $request): UserResource
    {
        $this->authorize('view', $request->user());

        return new UserResource($request->user());
    }

    public function update(UserRequest $request, User $user): UserResource
    {
        $this->authorize('update', $user);

        $attributes = $request->only(['name']);

        $user->update($attributes);

        return new UserResource($user);
    }
}
