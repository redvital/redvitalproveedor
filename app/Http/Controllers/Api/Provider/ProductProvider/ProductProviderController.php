<?php

namespace App\Http\Controllers\Api\Provider\ProductProvider;

use Error;
use App\Models\Product;
use App\Models\Provider;
use App\Rules\ExcelRule;
use Illuminate\Http\Request;
use App\Jobs\ImportProductJob;
use App\Models\ProductProvider;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductProviderImport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ProductProviderResource;

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
        'image' =>'mimes:png,jpg,jpeg'
    ];
    public function listProductForSupplier(Product $product){
            $pivot = ProductProvider::where('product_id', $product->id)->get();
            return $pivot;
            $ejemplo = $product->providers;
            // todo: implementar pagination agregar estructura del resource
            return $ejemplo;
    }
    public function listSupplierForProduct(Request $request,Provider $provider_id){
        // $approved = $request->query('approved');
        // $commercialized = $request->query('commercialized');
        $collection = $provider_id->products;
        return ProductProviderResource::collection($collection);
        return $collection->filter(function($item){
            return $item ;
            // finalizar filtro
        });
        $ejemplo = $provider_id->products()->with('ProductProvider.provider')->get()->pluck('ProductProvider')->collapse();
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
            return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
        }
        
         $productRequest = Product::where('sku_provider', $request->sku_provider)->first();
        
        if($productRequest){
            return $this->successMessage("sku de proveedor registrado : $request->sku_provider");
        }
        $file = $request->file('image');
        if(empty($file)){
            $data = $request->all();
        }else{
            // todo: ejemplo para unir dos array y mandarlo con el modelo
            $awsRutafile = Storage::disk('s3')->put("imagen-productos-proveedor",  $file, 'public'); 
            $data = array_merge(
                $request->all(), [
                    "image" =>$awsRutafile,
                ],
            );
        }
          
        try{
            $product = Product::create($data);
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
       
        
         $validate = Validator::make($request->all(), [
             'import' => ['required', new ExcelRule($request->file('import'))],
         ]);
         if ($validate->fails()) {
             return $this->errorResponse($validate->errors(), Response::HTTP_BAD_REQUEST);
         }
     
        error_log("ejecutado importancion");
        $job = new ImportProductJob(
            $request->file('import'),
            $request->user(),
            $supplier_id
        );

        $this->dispatch($job);

        return $this->successMessage($job->respuestaJson());
      
    }  
}
// update information