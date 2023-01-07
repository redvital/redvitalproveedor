<?php

namespace App\Http\Controllers\Api\Webhook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class WebhookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('handler');
    }


    public function handle(Request $request)
    {

        if($request->input('object') == 'event') {
           
            switch ($request->type) {

            case 'token.creation.succeeded':
                //codigo para el evento aqui 
                Log::info('Evento recibido de TOKEN creado'); 
                break;

            case 'charge.creation.succeeded':
                //codigo para el evento aqui
                Log::info('Evento recibido de CARGO creado'); 
                break;

            }
            
            Log::info($request);
        
        }
    }
}
