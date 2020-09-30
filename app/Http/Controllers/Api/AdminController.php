<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactQuery;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use stdClass;

class AdminController extends Controller
{
  public function contact(ContactRequest $request)
  {
    if ($request->honeyPot || $request->honeyCount) {

      Log::warning('Bot Detected!: ' . $request);
      return "Trapped";
    }

    Mail::to(env('MAIL_ADMIN_ADDRESS'))->send(new ContactQuery($request));
  }
}
