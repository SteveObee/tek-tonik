<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    // return parent::toArray($request);
    return [
      'id' => $this->id,
      'name' => $this->name,
      'category_id' => $this->category_id,
      'sub_categories' => CategoryResource::collection($this->whenLoaded('subCategories')),
      'recursive_products' => CategoryResource::collection($this->whenLoaded('recursiveProducts')),
      'products' => ProductResource::collection($this->whenLoaded('products'))
    ];
  }
}
