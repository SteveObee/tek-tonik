<?php

namespace App\Providers;

use App\Http\Resources\AddressResource;
use App\Http\Resources\ProductResource;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    Cashier::ignoreMigrations();
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
