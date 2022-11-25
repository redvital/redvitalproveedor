<?php

namespace App\Http\Controllers\Api\Provider\ProductProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\ProductProvider;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Imports\ProductProviderImport;
use App\Http\Resources\ProductProviderResource;
use Error;
use Illuminate\Support\Facades\Storage;

class ProductProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $rules = [
        'name' => 'required',
        'category' => 'required',
        'sku_provider' => 'required',
        'bar_code' => 'required',
        'method_of_payment' => 'required',
        'condition'=> 'required',
        'currency' => 'required',
        'cost_per_unit' => 'required',
        'cost_per_package' => 'required',
        'sugessted_price' => 'required',
        
    ];
    public function listProductForSupplier(Product $product){
            $pivot = ProductProvider::where('product_id', $product->id)->get();
            $ejemplo = $product->providers;
            return $ejemplo;
    }
    public function listSupplierForProduct(Provider $provider){
        // $pivot = ProductProvider::where('product_id', $product->id)->get();
        $ejemplo = $provider->products()->with('ProductProvider.provider')->get()->pluck('ProductProvider')->collapse();

        return $ejemplo;
}
    public $errorSkuProvider = 'Sku Provider already exists';

    public function index(Request $request, ProductProvider $supplier_id){

        $approved = $request->query('approved');
        $commercialized = $request->query('commercialized');

        if($approved){
            $pivot = ProductProvider::where('provider_id', $supplier_id->id)->where('approved', $approved ==='true' ? 1 : 0 )->get();
        } else if($commercialized){
            $pivot = ProductProvider::where('provider_id', $supplier_id->id)->where('commercialized', $commercialized ==='true' ? 1 : 0 )->get();
        } else {
            $pivot = ProductProvider::where('provider_id', $supplier_id->id)->get();
        }

        if(!empty($pivot)){
            $productsProvider = $pivot->map(function ($element) {
                return  $element->product_id;
            });
            $products = ProductProviderResource::collection(Product::whereIn('id', $productsProvider)->get());
            return $this->paginate($products);
        }else {
            return $this->errorResponse('No products found for this supplier', Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Provider $supplier_id)
    {
        $validate = Validator::make($request->all(), $this->rules);
        if ($validate->fails()) {
            return $this->errorResponse($validate, Response::HTTP_BAD_REQUEST);
        }
        
         $productRequest = Product::where('sku_provider', $request->sku_provider)->first();
        
        if($productRequest){
            return $this->successMessage("sku de proveedor registrado : $request->sku_provider");
        }
        $file = $request->file('image');
            $awsRutafile = Storage::disk('s3')->put("imagen-productos-proveedor",  $file, 'public');
        try{
              $data = array_merge(
                $request->all(), [
                    "image" =>$awsRutafile,
                    ],);
            $product = Product::create(
                $data
            );
            $validateProduct = ProductProvider::where('product_id', $product->id )->where('provider_id', $supplier_id->id)->first();
            if(!$validateProduct){   
                $productsProvider = ProductProvider::create([
                'product_id' => $product->id,
                'provider_id' => $supplier_id->id,
            ]);
            return $this->showOne($productsProvider, 201); 
        }
        return $this->successMessage("Producto creado $supplier_id->name ");
         
        }
        catch(\Exception $e){
            error_log($e);
            return $this->errorResponse("Error en el controlador", Response::HTTP_BAD_REQUEST);
        }
     

       

        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request, Provider $supplier_id)
    {
        $validate = Validator::make($request->all(), ['import' => 'required']);
        if ($validate->fails()) {
            return $this->errorResponse($validate, Response::HTTP_BAD_REQUEST);
        }
        $fileProducts = $request->file('import');
        try{
            Excel::import(new ProductProviderImport($supplier_id), $fileProducts);
            return $this->successMessage('Producto cargado Exitosamente',200);
        }
        catch(\Exception $e){
            
            error_log($e);
            return $this->errorResponse("Error al exportar los productos, valide que los campos requerido estan completos", Response::HTTP_BAD_REQUEST);
        }
      
    }  
}
