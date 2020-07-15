<?php

namespace App\Http\Resources;

use App\BasketItem;
use Illuminate\Http\Resources\Json\JsonResource;

class BasketResource extends JsonResource
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
      'user_id' => $this->user_id,
      'items' => BasketItemResource::collection($this->whenLoaded('basketItems')),
      'itemOptions' => BasketItemResource::collection($this->whenLoaded('basketOptions'))
    ];
  }
}
