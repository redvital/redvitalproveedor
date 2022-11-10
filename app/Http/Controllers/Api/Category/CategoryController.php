<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    private $rules = [
        'name' => 'required',
        'description' => 'required',

    ];
    public function index()
    {
        $category = CategoryResource::collection(Category::all());
        return $this->paginate($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, $this->rules);
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $category = Category::create(
            $request->all(),
        );
        return $this->showOne($category, 201);
    }

    public function show(Request $request, Category $category)
    {
        return $this->showOne($category);

    }

    /**

     */
    public function update(Request $request, Category $category)
    {

        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        $category->update($request->all());
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->showOne($category);
    }
}
