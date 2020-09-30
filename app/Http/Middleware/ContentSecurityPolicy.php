<?php

namespace App\Http\Middleware;

use Closure;

class ContentSecurityPolicy
{
  public function handle($request, Closure $next)
  {
    $response = $next($request);

    $response->headers->set('Content-Security-Policy', "Content-Security-Policy: default-src 'self' *.stripe.com");

    return $response;
  }
}
