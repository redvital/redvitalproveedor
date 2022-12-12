<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Provider;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductProvider;

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
        for ($i = 2; $i < count($rows); $i++) {
             $row = $rows[$i];
            ($categoryValitade = Category::whereName($row['2'])->first()) ?
                $categoryValitade :
                $categoryValitade = Category::create(['name' => $row[2]]);
             $product = [
                'name' => $row['0'],
                'sku_provider'   => $row['1'],
                'category'   => $categoryValitade->id,
                'bar_code'=>$row['3'],
                'condition'=>$row['4'],
                'drive_unit' => $row['5'],
                'payment_condition' => $row['6'],
                'currency'=>$row['7'],
                'pack_quantity' => $row['9'],
                'cost_per_package' => $row['10'],
                'discount' => $row['11'],
                'cost_per_unit' => $row['12'],
                'sugessted_price'=>$row['13'],
                'method_of_payment' => $row['14']
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
              
             $productsProvider = ProductProvider::create([
                'product_id' => $productNew->id,
                'provider_id' => $this->provider->id,
                    ]);
                }
            }
            
           
           
        }
        
        // $result = implode(',',$product)
       
    }
}
