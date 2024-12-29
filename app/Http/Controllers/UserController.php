<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $user = $this->service->getAll();
        return UserResource::collection($user);
    }

    public function store(UserRequest $request)
    {
        $dto = UserDTO::fromRequest($request);
        $user = $this->service->create($dto);
        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user)
    {
        $dto = UserDTO::fromRequest($request);
        $updatedUser = $this->service->update($user, $dto);
        return new UserResource($updatedUser);
    }

    public function destroy(User $user)
    {
        $this->service->delete($user);
        return response(null, 204);
    }

}
