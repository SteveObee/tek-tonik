<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
  public function index(Request $request)
  {
    // return CategoryResource::collection(Category::find(1)->subCategories);
    return CategoryResource::collection(Category::all());
  }

  public function recursed(Request $request)
  {
    // return CategoryResource::collection(Category::find(1)->subCategories);
    return CategoryResource::collection(Category::find(1)->subCategories);
  }

  public function recursiveCategoryIds(Category $category, Request $request)
  {
    $CategoryIds = Category::find($category->id)->recursiveCategoryIds;
    $CategoryIdCollection = collect($CategoryIds->toArray());
    $flattenedUniqueValues = $CategoryIdCollection
      ->push($category->id)
      ->flatten()
      ->unique()
      ->values();

    return $flattenedUniqueValues;
  }
}
