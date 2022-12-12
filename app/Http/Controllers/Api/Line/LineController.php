<?php

namespace App\Http\Controllers\Api\Line;

use App\Http\Controllers\Controller;
use App\Models\Line;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\LineResource;

class LineController extends Controller
{

    private $rules = [
        'name' => 'required',
        'code' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $line = LineResource::collection(Line::all());
        return $this->paginate($line);
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
        $line = Line::create(
            $request->all(),
        );
        return $this->showOne($line, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Line $line)
    {
        return $this->showOne($line);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Line $line)
    {
        $line->fill($request->all());
        if($line->isClean())
        {
            return $this->errorResponse("Al menos un valor debe cambiar" , Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $line->save();
        return $this->showOne($line);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Line $line)
    {
        $line->delete();
        return $this->showOne($line);
    }
}
// add