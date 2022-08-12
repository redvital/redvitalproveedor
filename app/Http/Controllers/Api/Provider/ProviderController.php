<?php

namespace App\Http\Controllers\Api\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProviderController extends Controller
{

    private $rules = [
        'category_id' => 'required',
        'agreement_id' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider = Provider::all();
        return $this->showAll($provider);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->rules);

        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $provider = Provider::create(
            $request->all(),
        );
        return $this->showOne($provider, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Provider $provider)
    {
        return $this->showOne($provider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {

        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $provider->update($request->all());
        return $this->showOne($provider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return $this->showOne($provider);
    }
}
