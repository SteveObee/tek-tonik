<?php

namespace App\Http\Resources;

use App\OrderStatusCode;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
      'order_items' => OrderItemResource::collection($this->orderItems),
      'address' => new AddressResource($this->shippingAddress),
      'status' => $this->status,
      'total' => $this->price_total,
      'created_at' => $this->created_at->format('d-m-Y')
    ];
  }
}
