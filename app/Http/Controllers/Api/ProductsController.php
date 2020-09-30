<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use App\Category;
use App\Option;
use App\OptionValue;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
  public function index(Request $request)
  {
    $categoryIdQuery = $request->query->get('category_ids');

    return ProductResource::collection(Product::orderBy('created_at', 'desc')
      ->when($categoryIdQuery, function ($query) use ($categoryIdQuery) {
        $query->whereIn('category_id', $categoryIdQuery);
      })
      ->get());
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

  public function updateQuantity(Product $product, Request $request)
  {
    try {
      $product->stock = $request->newStock;
      $product->save();

      return response()->json([
        'success' => true
      ], 200);
    } catch (\Throwable $th) {
      return response()->json([
        'error' => $th
      ], 400);
    }
  }

  public function productQuantity(Product $product)
  {
    return $product->stock;
  }

  public function productsByCategory(Request $request, Category $category)
  {
    $brandIdQuery = $request->query->get('brand_id');

    return (new ProductCollection(Category::find($category->id)
      ->products()
      ->orderBy('created_at', 'desc')
      /* ->when($brandIdQuery, function ($query) use ($brandIdQuery) {
        $query->whereIn('brand_id', $brandIdQuery);
      }) */
      ->get()))
      ->additional(['meta' => [
        'category_name' => $category->name,
      ]]);
  }

  public function destroy(Product $product)
  {
    $product->options()->detach();

    $product->delete();

    return response(null, 204);
  }
}
