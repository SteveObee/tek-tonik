<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class MacroServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    /* Collection::macro('flattenTree', function ($childrenField = 'children', $levelAttribute = 'level') {
      $toProcess = $this->items;
      $processed = [];
      while ($item = array_shift($toProcess)) {
        $item->$levelAttribute++;
        $processed[] = $item;
        if (count($item->$childrenField) > 0) {
          $children = array_reverse($item->$childrenField->items);
          foreach ($children as $child) {
            $child->$levelAttribute = $item->$levelAttribute;
            array_unshift($toProcess, $child);
          }
        }
      }
      return Collection::make($processed);
    }); */
    Collection::macro('flattenKeepKeys', function ($depth = 1, $dotNotation = false) {
      if ($depth) {
        $newArray = [];
        foreach ($this->items as $parentKey => $value) {
          if (is_array($value)) {
            $valueKeys = array_keys($value);
            foreach ($valueKeys as $key) {
              $subValue = $value[$key];
              $newKey = $key;
              if ($dotNotation) {
                $newKey = "$parentKey.$key";
                if ($dotNotation !== true) {
                  $newKey = "$dotNotation.$newKey";
                }

                if (is_array($value[$key])) {
                  $subValue = collect($value[$key])->flattenKeepKeys($depth - 1, $newKey)->toArray();
                }
              }
              $newArray[$newKey] = $subValue;
            }
          } else {
            $newArray[$parentKey] = $value;
          }
        }

        $this->items = collect($newArray)->flattenKeepKeys(--$depth, $dotNotation)->toArray();
      }

      return collect($this->items);
    });
  }
}
