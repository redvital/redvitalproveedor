<?php

namespace App\Http\Controllers\Api\Provider\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Automattic\WooCommerce\Client;

class ProductController extends Controller
{
    public function show(Product $product_id)
    {

        return $this->showOne($product_id);
    }

    public function update(Request $request, Product $product_id)
    {
        $product_id->fill($request->all());
        if ($product_id->isClean()) {
            return $this->errorResponse("Al menos un valor debe cambiar", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $product_id->save();
        return $this->showOne($product_id);
    }

    public function syncproduct()
    {
        // Conexión WooCommerce API destino
        // ================================
        $url_API_woo = 'https://tiendalab.redvital.com/';
        $ck_API_woo = 'ck_4614e2cad09b80454895a043c8f97f2ac5103365';
        $cs_API_woo = 'cs_b3893ea03fea23bb960369717c8157b098934bee';

        $woocommerce = new Client(
            $url_API_woo,
            $ck_API_woo,
            $cs_API_woo,
            ['version' => 'wc/v3']
        );
        // ================================


        // Conexión API origen
        // ===================
        $url_API = "http://redvitalproveedor.test/api/product/1";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url_API);

        $items_origin = curl_exec($ch);
        curl_close($ch);

        // ===================

        
        $items_origin = json_decode($items_origin, true);

        // formamos el parámetro de lista de SKUs a actualizar
        $param_sku = '';
        foreach ($items_origin as $item) {
            $param_sku .= $item['sku'] . ',';
        }

        $products = $woocommerce->get('products/?sku=' . $param_sku);

        // Construimos la data en base a los productos recuperados
        $item_data = [];
        foreach ($products as $product) {

            // Filtramos el array de origen por sku
            $sku = $product->sku;
            $search_item = array_filter($items_origin, function ($item) use ($sku) {
                return $item['sku'] == $sku;
            });
            $search_item = reset($search_item);

            // Formamos el array a actualizar
            $item_data[] = [
                'id' => $product->id,
                'regular_price' => $search_item['price'],
                'stock_quantity' => $search_item['qty'],
            ];
        }

        // Construimos información a actualizar en lotes
        $data = [
            'update' => $item_data,
        ];

        // Actualización en lotes
        $result = $woocommerce->post('products/batch', $data);

        if (!$result) {
            echo ("❗Error al actualizar productos \n");
        } else {
            print("✔ Productos actualizados correctamente \n");
        }
    }
}
