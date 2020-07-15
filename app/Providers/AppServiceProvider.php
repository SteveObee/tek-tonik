<?php

namespace App\Providers;

use App\Http\Resources\AddressResource;
use App\Http\Resources\ProductResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    AddressResource::withoutWrapping();
    ProductResource::withoutWrapping();
  }
}
