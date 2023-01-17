<?php

namespace App\Http\Controllers\Api\Webhook;

use App\Http\Controllers\Controller;
use App\Models\Webhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\WebhookResource;
use Illuminate\Support\Facades\Validator;


class WebhookController extends Controller
{
    private $rules = [
        'body' => 'required',
        'aprobado' => 'required',

    ];

    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show','handler');
    }


    public function index(Request $request)
    {
        $webhook = WebhookResource::collection(Webhook::all());
        return $this->paginate($webhook);
    }

    public function store(Request $request)
    {
        // $this->validate($request, $this->rules);
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $webhook = Webhook::create(
            $request->all(),
        );
        return WebhookResource::make($webhook);
    }



    public function show(Request $request, Webhook $webhook)
    {
        return $this->showOne($webhook);

    }

    public function update(Request $request, Webhook $webhook)
    {

        $webhook->fill($request->all());
        if($webhook->isClean())
        {
            return $this->errorResponse("actualizado" , Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $webhook->update($request->all());

        return WebhookResource::make($webhook);
    }

}
