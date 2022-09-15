<?php

namespace App\Http\Controllers\Api\Representative;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Representative;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RepresentativeController extends Controller
{

    private $rules = [
        'commercial_register' => 'required',
        'representatives_document' => 'required',
        'rif' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $representative = Representative::all();
        return $this->showAll($representative);
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
        $representative = Representative::create(
            $request->all(),
        );
        return $this->showOne($representative, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Representative $representative)
    {
        return $this->showOne($representative);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Representative $representative)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $representative->update($request->all());
        return $this->showOne($representative);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Representative $representative)
    {
        $representative->delete();
        return $this->showOne($representative);
    }
}
