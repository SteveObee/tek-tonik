<?php

namespace App\Http\Controllers\Api;

use App\Basket;
use App\BasketItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BasketController extends Controller
{
  public function show(Basket $basket)
  {
    return new BasketResource;
  }

  // public function show(Basket $basket)
  // {
  //   return BasketResource::collection(BasketItem::find(1));
  // }
}
