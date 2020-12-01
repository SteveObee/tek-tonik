<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Order;
use Illuminate\Http\Request;

class SpaController extends Controller
{
  public function index()
  {
    return view('spa');
  }
}
