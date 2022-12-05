<?php

namespace App\Http\Controllers\Api\ProductAddInformation;

use App\Http\Controllers\Controller;
use App\Models\ProductAddInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductAddInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $rules = [
        'code' => 'required',
        'brand' => 'required',
        'sub_brand' => 'required',
        'line' => 'required',
        'sub_category' => 'required'];

    public function index()
    {
        $add_inf = ProductAddInformation::all();
        return $this->showAll($add_inf);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $add_inf = ProductAddInformation::create(
            $request->all(),
        );
        return $this->showOne($add_inf, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ProductAddInformation $add_inf)
    {
        return $this->showOne($add_inf);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductAddInformation $add_inf)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $add_inf->fill($request->all());
        if ($add_inf->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $add_inf->save();
        return $this->showOne($add_inf);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductAddInformation $add_inf)
    {
        $add_inf->delete();
        return $this->showOne($add_inf);
    }
}
