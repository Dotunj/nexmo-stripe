<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewSaleOccurred;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();

        if($payload['type'] == 'charge.succeeded'){
           Notification::route('nexmo', config('services.nexmo.sms_from'))
                        ->notify(new NewSaleOccurred($payload));
        }

        return response('Webhook received');
    }
}
