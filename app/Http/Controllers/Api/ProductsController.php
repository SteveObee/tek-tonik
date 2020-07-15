<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Product;
use App\Option;
use App\OptionValue;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
  public function index()
  {
    return ProductResource::collection(Product::orderBy('created_at', 'desc')->paginate(5));
  }

  public function show(Product $product)
  {
    $product->colors;
    $product->brand;

    return new ProductResource($product);
  }

  public function productImages(Product $product)
  {
    return ProductResource::collection($product->images()->simplePaginate(3));
  }

  public function destroy(Product $product)
  {
    $product->options()->detach();

    $product->delete();

    return response(null, 204);
  }
}
