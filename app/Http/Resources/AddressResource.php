<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */

  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'address_line_1' => $this->address_line_1,
      'address_line_2' => $this->address_line_2,
      'city' => $this->city,
      'county' => $this->county,
      'postcode' => $this->postcode,
      'users' => UserResource::collection($this->whenLoaded('users')),
      'is_shipping' => $this->whenPivotLoaded('customer_addresses', function () {
        return $this->pivot->is_shipping;
      }),
      'is_billing' => $this->whenPivotLoaded('customer_addresses', function () {
        return $this->pivot->is_billing;
      })
    ];
  }
}
