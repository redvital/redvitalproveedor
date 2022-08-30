<?php

namespace App\Http\Controllers\Api\SubBrand;

use App\Http\Controllers\Controller;
use App\Models\SubBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SubBrandController extends Controller
{

    private $rules = [
        'code' => 'required',
        'id_brand' => 'required',
        'name' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subBrand = SubBrand::all();
        return $this->showAll($subBrand);
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
        $subBrand = SubBrand::create(
            $request->all(),
        );
        return $this->showOne($subBrand, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SubBrand $subbrand)
    {
        return $this->showOne($subbrand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubBrand $subbrand)
    {

        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $subbrand->update($request->all());
        return $this->showOne($subbrand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubBrand $subbrand)
    {
        $subbrand->delete();
        return $this->showOne($subbrand);
    }
}
