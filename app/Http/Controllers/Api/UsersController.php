<?php

namespace App\Http\Controllers\Api;

use App\Basket;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\AddressResource;
use App\Http\Resources\BasketResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\UserRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
  public function index()
  {
    return UserResource::collection(User::orderBy('created_at', 'desc')->paginate(10));
  }

  public function getToken(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      throw ValidationException::withMessages([
        'email' => ['The provided credentials are incorrect.'],
      ]);
    }

    return $user->createToken('secret')->plainTextToken;
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
      'password' => Hash::make($data['password'])
    ]));
  }

  public function update(User $user, UserRequest $request)
  {

    $data = $request->validated();

    $user->update($data);

    return new UserResource($user);
  }

  public function userAddresses(Request $request)
  {
    return AddressResource::collection(User::find(Auth::id())->addresses()->orderBy('created_at', 'desc')->paginate(3));
  }

  public function userOrders(Request $request)
  {
    return OrderResource::collection(User::find(Auth::id())->orders()->orderBy('ref_order_status_code_id', 'asc')->get());
  }

  public function allUserAddresses(Request $request)
  {
    return AddressResource::collection(User::find(Auth::id())->addresses()->orderBy('created_at', 'desc')->get());
  }

  public function userBasket(Request $request)
  {
    $userBasket = Basket::where('user_id', Auth::id())->first();
    $userBasket->basketItems;
    $userBasket->basketOptions;

    return new BasketResource($userBasket);
  }

  public function chargeUser(Request $request)
  {
    $user = User::find(Auth::id());

    try {
      $stripeCharge = $user->charge($request->amount, $request->id);

      return response()->json([
        'success' => true
      ]);
    } catch (Exception $e) {
      return response($e, 500);
    }
  }

  public function destroy(User $user)
  {
    # Delete user addresses
    $user->deleteAddresses();

    # Delete user
    $user->delete();

    return response(null, 204);
  }
}
