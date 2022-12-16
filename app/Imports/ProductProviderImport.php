<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Provider;
use App\Models\Condition;
use App\Models\PaymentMethods;
use App\Models\ProductProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProductProviderImport implements ToCollection
{
    
    /**
    * @param Collection $collection
    */
    public $provider;

    public function __construct(Provider $provider )
    {
        $this->provider = $provider;
    }

    public function collection(Collection $rows)
    {       
        for ($i = 3; $i < count($rows); $i++) {
             $row = $rows[$i];

            //  error_log(strval($row));z
             error_log($row['2']);
             error_log("iteraciiion $i");
             
            ($categoryValitade = Category::where('name',$row['2'])->first()) 
                ?$categoryValitade 
                :$categoryValitade = Category::create(["name" => "hola", 'description' => "ejemplo"]);
                error_log($categoryValitade);
            ($condicionPago = Condition::where('condition', $row['6'])->first())
                ? $condicionPago
                : $condicionPago =  Condition::create(['condition' => $row['6']]);
                 error_log($condicionPago);

            ($metodos = PaymentMethods::where('payment_method', $row['14'])->first())
            ?$metodos 
            :$metodos = PaymentMethods::create(['payment_method' => $row['14']]);
            error_log($metodos);
             $product = [
                'name' => $row['0'],
                'sku_provider'   => $row['1'],
                'category'   => $categoryValitade->id,
                'bar_code'=>$row['3'],
                'condition'=>$row['4'],
                'drive_unit' => $row['5'],
                'payment_condition' => $condicionPago->id,
                'currency'=>$row['7'],
                'pack_quantity' => $row['9'],
                'cost_per_package' => $row['10'],
                'discount' => $row['11'],
                'cost_per_unit' => $row['12'],
                'sugessted_price'=>$row['13'],
                'method_of_payment' => $metodos->id
             ];
             $validator = Validator::make($product, [
                'name' => 'required',
                'sku_provider' => 'required',
                'category' => 'required',
                'bar_code' => 'required',
                'condition' => 'required',
                'currency' => 'required',
                'cost_per_package' => 'required',
                'cost_per_unit' => 'required',
                'sugessted_price' => 'required',
                'method_of_payment' => 'required',
            ]);
           
            if ($validator->fails()) {
                continue;
            }else{
                $validateProduct = Product::where('name', $row['0'])->where('sku_provider', $row['1'])->first();
            if ($validateProduct) {
                  $validateProduct->update($product);
            }else{
                $productNew = Product::create($product);
                ProductProvider::create([
                'product_id' => $productNew->id,
                'provider_id' => $this->provider->id,
                    ]);
                }
            }
            
           
           
        }
        
        // $result = implode(',',$product)
       
    }
}
