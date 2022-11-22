<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Provider;
use App\Models\Product;
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
        // error_log($rows);
        error_log($this->provider->id);

        
        for ($i = 2; $i < count($rows); $i++) {
             $row = $rows[$i];
            $categoryValitade= Category::where('name', $row['2'])->first();
            return $categoryValitade;
            error_log($categoryValitade,'error');
            error_log('validate category');
             $product = [
                'name' => $row['0'],
                'sku'   => $row['1'],
                'category'   => $row['2'],
                'bar_code'=>$row['3'],
                'condition'=>$row['4'],
                'currency'=>$row['5'],
                'cost_per_package' => $row['6'],
                'cost_per_unit'=>$row['7'],
                'sugessted_price'=>$row['8'],
             ];
             $productSave = Product::create($product);
             error_log(implode($productSave));
            //  $productsProvider = ProductProvider::create([
            //     'product_id' => $productSave->id,
            //     'provider_id' => $this->id,
            // ]);
        }
        
        // $result = implode(',',$product)
       
    }
}
