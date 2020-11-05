<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\AddressHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AddressesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return AddressResource::collection(Address::orderBy('created_at', 'desc')->paginate(10));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(AddressRequest $request)
  {
    # Store validated request
    $validated = $request->validated();

    # Find models matching matching provided validated props
    $matchedAddresses = Address::find(1)->findAddress(
      $validated['address_line_1'],
      $validated['postcode']
    )->get();

    # Convert collection to array for comparison
    foreach ($matchedAddresses->toArray() as $key => $value) {
      # Store id for later
      $id = $value['id'];
      # Remove id before comparing
      unset($value['id']);

      # Check if array items match provided validated array
      if ($value == $validated) {
        # Get matched item's address
        $existingAddress = Address::find($id);
        # Check if the currently authorised user is associated with address
        $user = $existingAddress->userIdPresent(Auth::id())->get();

        # If authorised user not associated, attach them
        if (!count($user)) {
          $existingAddress->users()->attach(Auth::id());
        };

        # Add address details to pivot table
        $existingAddress->users()->updateExistingPivot(
          Auth::id(),
          [
            'is_shipping' => $request->is_shipping,
            'is_billing' => $request->is_billing
          ]
        );

        # Retrieve associated users for address
        $existingAddress->users;

        return new AddressResource($existingAddress);;
      }
    }

    # Validated data doesn't match existing addresses.  Create new address
    $newAddress = Address::create($validated);

    # Attach authorised user to newly created address
    $newAddress->users()->attach(Auth::id(), [
      'is_shipping' => $request->is_shipping,
      'is_billing' => $request->is_billing
    ]);

    # Retrieve associated users for address
    $newAddress->users;

    return new AddressResource($newAddress);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Address $address)
  {
    $address->users;
    $address->orders;

    return new AddressResource($address);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Address $address, AddressRequest $request)
  {
    /* $validated = $request->validated();

    $address->update($validated);

    $validated['address_created_at'] = $address->created_at;
    $record = new AddressHistory($validated);

    $address->records()->save($record);

    $address->users()->updateExistingPivot($record, [
      'is_shipping' => $validated->is_shipping,
      'is_billing' => $validated->is_billing,
      'is_active' => $validated->is_active,
    ]);

    return new AddressResource($address); */
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Address $address)
  {
    $address->users()->detach(Auth::id());

    $remainingUsers = $address->users;
    $attachedOrders = $address->orders;

    if (!count($remainingUsers) && !count($attachedOrders)) {
      $address->delete();
    }

    return response(null, 204);
  }
}
