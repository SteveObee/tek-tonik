<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
  public function index()
  {
    return UserResource::collection(User::orderBy('created_at', 'desc')->paginate(10));
  }

  public function show(User $user)
  {
    return new UserResource($user);
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8'],
    ]);

    return new UserResource(User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]));
  }

  public function update(User $user, UserRequest $request)
  {

    $data = $request->validated();

    $user->update($data);

    return new UserResource($user);
  }

  public function destroy(User $user)
  {
    $user->delete();

    return response(null, 204);
  }
}
