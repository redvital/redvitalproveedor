<?php

namespace App\Http\Controllers\Api\Provider\ProviderType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProviderType;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\DDList\ProviderTypeDDList;

class ProviderTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $rules = [
        'provider_type' => 'required'];

    public function index()
    {
        $provider_type = ProviderType::all();
        return $this->showAll($provider_type);
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
        $provider_create_type = ProviderType::create(
            $request->all(),
        );
        return $this->showOne($provider_create_type, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProviderType $provider_type)
    {
        return $this->showOne($provider_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProviderType $provider_type)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $provider_type->fill($request->all());
        if ($provider_type->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $provider_type->save();
        return $this->showOne($provider_type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProviderType $provider_type)
    {
        $provider_type->delete();
        return $this->showOne($provider_type);
    }

    public function getDDList()
    {
        $provider_type_dd_list = ProviderTypeDDList::collection(ProviderType::all());
        return $provider_type_dd_list;
    }
}
