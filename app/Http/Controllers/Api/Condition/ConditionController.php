<?php

namespace App\Http\Controllers\Api\Condition;

use App\Http\Controllers\Controller;
use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\DDList\ConditionDDListResource;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $rules = [
        'condition' => 'required'];

    public function index()
    {
        $condition = Condition::all();
        return $this->showAll($condition);
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
        $condition = Condition::create(
            $request->all(),
        );
        return $this->showOne($condition, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Condition $condition)
    {
        return $this->showOne($condition);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, Condition $condition)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $condition->fill($request->all());
        if ($condition->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $condition->save();
        return $this->showOne($condition);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Condition $condition)
    {
        $condition->delete();
        return $this->showOne($condition);
    }

    public function ddlist()
    {
        $condition = ConditionDDListResource::collection(Condition::all());
        return $condition;
    }
}
