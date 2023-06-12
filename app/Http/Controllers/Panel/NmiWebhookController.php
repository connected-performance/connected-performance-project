<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

class NmiWebhookController extends Controller
{
    public function sale(Request $request)
    {
        Log::info($request);
    }
}
