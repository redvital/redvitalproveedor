<?php

namespace App\Http\Controllers\Api\Provider\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class ProductController extends Controller
{
    public function show(Product $product_id)
    {
        
        return $this->showOne($product_id);
    }

    public function update(Request $request, Product $product_id)
    {
        $product_id->fill($request->all());
        if($product_id->isClean())
        {
            return $this->errorResponse("Al menos un valor debe cambiar" , Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $product_id->save();
        return $this->showOne($product_id);
    }
}
