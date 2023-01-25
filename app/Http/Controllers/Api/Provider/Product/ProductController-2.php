<?php

namespace App\Http\Controllers\Api\Provider\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Automattic\WooCommerce\Client;



class ProductController extends Controller
{   
    // akk
    protected $url_API_woo = 'https://tiendalab.redvital.com/';
    protected $ck_API_woo = 'ck_30d8177bbd2079a7f48514b3c95e100315809c08';
    protected $cs_API_woo = 'cs_2990176effab08a91db311702de9a7712623838f';
    // end akk

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

        // akk
        $woocommerce = new Client(
            $this->url_API_woo,
            $this->ck_API_woo,
            $this->cs_API_woo,
            ['version' => 'wc/v3']
        );
        
        $product = $woocommerce->get('products/?sku='. $product_id->sku_provider)[0];
        return $product;
        $data = [
            'regular_price' => '22.4',
            'stock_quantity' => 3000
        ];
        return $woocommerce->put('products/'.$product->id.'/variations/'.$request->variation, $data);
        // end akk

        $product_id->save();
        return $this->showOne($product_id);
        

        
    }
}
