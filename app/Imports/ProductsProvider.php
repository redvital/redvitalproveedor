<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Models\Provider;

class ProductsProvider implements ToCollection, WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
    public $provider;

    public function __construct(Provider $provider )
    {
        $this->provider = $provider;
    }

    public function collection(Collection $products)
    {
        //
    }
}
