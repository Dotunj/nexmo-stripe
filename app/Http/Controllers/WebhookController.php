<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\NewSaleOccurred;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();

        if($payload['type'] == 'charge.succeeded'){
            dispatch(new NewSaleOccurred($payload));
        }

        return response('Webhook received');
    }
}
