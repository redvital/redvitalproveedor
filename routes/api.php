<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Store\StoreController;
use App\Http\Controllers\Api\Brand\BrandController;
use App\Http\Controllers\Api\SubBrand\SubBrandController;
use App\Http\Controllers\Api\Line\LineController;
use App\Http\Controllers\Api\Provider\ProviderController;
use App\Http\Controllers\Api\SupplierBankDetails\SupplierBankDetailsController;
use App\Http\Controllers\Api\Representative\RepresentativeController;
use App\Http\Controllers\Api\AdditionalSupplierInformation\AdditionalSupplierInformationController;
use App\Http\Controllers\Api\Provider\ProductProvider\ProductProviderController;
use App\Http\Controllers\Api\Stock\StockController;
use App\Http\Controllers\Api\Bank\BankController;
use App\Http\Controllers\Api\Coin\CoinController;
use App\Http\Controllers\Api\Condition\ConditionController;
use App\Http\Controllers\Api\PaymentMethod\PaymentMethodController;
use App\Http\Controllers\Api\PaymentType\PaymentTypeController;
use App\Http\Controllers\Api\SpecialFormOfPayment\SpecialFormsOfPaymenController;
use App\Http\Controllers\Api\State\StateController;
use App\Http\Controllers\Microservice\StockServiceController;
use App\Http\Controllers\Microservice\TiendaServiceController;
use App\Http\Controllers\Microservice\ProductoServiceController;
use App\Http\Controllers\Microservice\ProveedorServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Stock
Route::get('/stock', [StockController::class , 'stock']);
Route::get('/store/stock', [StockController::class , 'index']);
Route::get('/stock/{stock_id}', [StockController::class , 'show']);
Route::get('/stock', [StockController::class , 'stock']);
Route::post('/store/{store_id}/supplier/{supplier_id}/stock', [StockController::class , 'store']);
Route::post('/store/{store_id}/supplier/{supplier_id}/stock/{stock_id}', [StockController::class , 'update']);
Route::delete('/stock/{stock_id}', [StockController::class , 'destroy']);
//End Stock


Route::post('login', [AuthController::class, 'login']);
Route::post('signup', [AuthController::class, 'signUp']);

//Pre Register Providers //
Route::post('/provider', [ProviderController::class, 'store']);
Route::post('/provider/{supplier_id}/supplierbankdetails', [SupplierBankDetailsController::class, 'store']);
Route::post('/provider/{supplier_id}/additionalsupplierinformation', [AdditionalSupplierInformationController::class, 'store']);
//End Pre Register Providers //

Route::middleware('auth:api')->group(function () {

Route::get('me', [AuthController::class, 'me']);
Route::post('logout', [AuthController::class, 'logout']);


Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category', [CategoryController::class, 'store']);
Route::get('/category/{category}', [CategoryController::class, 'show']);
Route::post('/category/{category}', [CategoryController::class, 'update']);
Route::delete('/category/{category}', [CategoryController::class, 'destroy']);

// Providers
Route::get('/provider', [ProviderController::class, 'index']);
Route::get('/provider/{provider}', [ProviderController::class, 'show']);
Route::post('/provider/{provider}', [ProviderController::class, 'update']);
Route::delete('/provider/{provider}', [ProviderController::class, 'destroy']);
//End Providers

// store
Route::get('/store', [StoreController::class, 'index']);
Route::post('/store', [StoreController::class, 'store']);
Route::get('/store/{store}', [StoreController::class, 'show']);
Route::post('/store/{store}', [StoreController::class, 'update']);
Route::delete('/store/{store}', [StoreController::class, 'destroy']);
Route::get('/store/{store_id}/products', [StoreController::class, 'store_products']);
// add stock for store
Route::get('/store/{store_id}/stock', [StoreController::class, 'list_stock']);
Route::post('/stock', [StoreController::class, 'addStock']);


// end store

// brand
Route::get('/brand', [BrandController::class, 'index']);
Route::post('/brand', [BrandController::class, 'store']);
Route::get('/brand/{brand}', [BrandController::class, 'show']);
Route::post('/brand/{brand}', [BrandController::class, 'update']);
Route::delete('/brand/{brand}', [BrandController::class, 'destroy']);
// end brand

// sub brand
Route::get('/subbrand', [SubBrandController::class, 'index']);
Route::post('/subbrand', [SubBrandController::class, 'store']);
Route::get('/subbrand/{subbrand}', [SubBrandController::class, 'show']);
Route::post('/subbrand/{subbrand}', [SubBrandController::class, 'update']);
Route::delete('/subbrand/{subbrand}', [SubBrandController::class, 'destroy']);
// end sub brand
// line
Route::get('/line', [LineController::class, 'index']);
Route::post('/line', [LineController::class, 'store']);
Route::get('/line/{line}', [LineController::class, 'show']);
Route::post('/line/{line}', [LineController::class, 'update']);
Route::delete('/line/{line}', [LineController::class, 'destroy']);
// end line

// Supplier Bank Details
Route::get('/provider/{supplier_id}/supplierbankdetails', [SupplierBankDetailsController::class, 'index']);
Route::get('/supplierbankdetails/{supplierBankDetails}', [SupplierBankDetailsController::class, 'show']);
Route::post('/supplierbankdetails/{supplierBankDetails}', [SupplierBankDetailsController::class, 'update']);
Route::delete('/supplierbankdetails/{supplierBankDetails}', [SupplierBankDetailsController::class, 'destroy']);
// End Supplier Bank Details

// Representative
Route::get('/representative', [RepresentativeController::class, 'index']);
Route::post('/provider/{supplier_id}/representative', [RepresentativeController::class, 'store']);
Route::get('/representative/{representative}', [RepresentativeController::class, 'show']);
Route::post('/representative/{representative}', [RepresentativeController::class, 'update']);
Route::delete('/representative/{representative}', [RepresentativeController::class, 'destroy']);
// End Representative

// Additional Supplier Information
Route::get('/provider/{supplier_id}/additionalsupplierinformation', [AdditionalSupplierInformationController::class, 'index']);
Route::get('/additionalsupplierinformation/{additionalSupplierInformation}', [AdditionalSupplierInformationController::class, 'show']);
Route::post('/additionalsupplierinformation/{additionalSupplierInformation}', [AdditionalSupplierInformationController::class, 'update']);
Route::delete('/additionalsupplierinformation/{additionalSupplierInformation}', [AdditionalSupplierInformationController::class, 'destroy']);
// End Additional Supplier Information

// Products Provider
Route::get('/example-list1/{product}', [ProductProviderController::class, 'listProductForSupplier']);
Route::get('/example-list2/{provider}', [ProductProviderController::class, 'listSupplierForProduct']);
Route::get('/supplier/{supplier_id}/products', [ProductProviderController::class, 'index']);
Route::post('/supplier/{supplier_id}/products', [ProductProviderController::class, 'store']);
Route::post('/supplier/{supplier_id}/products-import', [ProductProviderController::class, 'import']);
/* importar productos */
Route::post('/supplier/{supplier_id}/importar-producto', [ProductProviderController::class, 'importProduct']);
/* exportar productos */
Route::get('/export/{producto}', [ProductProviderController::class, 'exportProduct']);

// End Products Provider



Route::get('/bank', [BankController::class, 'index']);
Route::post('/bank', [BankController::class, 'store']);
Route::get('/bank/ddlist', [BankController::class, 'getDDList']);
Route::get('/bank/{bank}', [BankController::class, 'show']);
Route::post('/bank/{bank}', [BankController::class, 'update']);
Route::delete('/bank/{bank}', [BankController::class, 'destroy']);

Route::get('/coin', [CoinController::class, 'index']);
Route::post('/coin', [CoinController::class, 'store']);
Route::get('/coin/ddlist', [CoinController::class, 'getDDList']);
Route::get('/coin/{coin}', [CoinController::class, 'show']);
Route::post('/coin/{coin}', [CoinController::class, 'update']);
Route::delete('/coin/{coin}', [CoinController::class, 'destroy']);

Route::get('/condition', [ConditionController::class, 'index']);
Route::post('/condition', [ConditionController::class, 'store']);
Route::get('/condition/ddlist', [ConditionController::class, 'getDDList']);
Route::get('/condition/{condition}', [ConditionController::class, 'show']);
Route::post('/condition/{condition}', [ConditionController::class, 'update']);
Route::delete('/condition/{condition}', [ConditionController::class, 'destroy']);

Route::get('/paymentmethod', [PaymentMethodController::class, 'index']);
Route::post('/paymentmethod', [PaymentMethodController::class, 'store']);
Route::get('/paymentmethod/ddlist', [PaymentMethodController::class, 'getDDList']);
Route::get('/paymentmethod/{payment_method}', [PaymentMethodController::class, 'show']);
Route::post('/paymentmethod/{payment_method}', [PaymentMethodController::class, 'update']);
Route::delete('/paymentmethod/{payment_method}', [PaymentMethodController::class, 'destroy']);

Route::get('/paymenttype', [PaymentTypeController::class, 'index']);
Route::post('/paymenttype', [PaymentTypeController::class, 'store']);
Route::get('/paymenttype/ddlist', [PaymentTypeController::class, 'getDDList']);
Route::get('/paymenttype/{payment_type}', [PaymentTypeController::class, 'show']);
Route::post('/paymenttype/{payment_type}', [PaymentTypeController::class, 'update']);
Route::delete('/paymenttype/{payment_type}', [PaymentTypeController::class, 'destroy']);

Route::get('/specialformofpayment', [SpecialFormsOfPaymenController::class, 'index']);
Route::post('/specialformofpayment', [SpecialFormsOfPaymenController::class, 'store']);
Route::get('/specialformofpayment/ddlist', [SpecialFormsOfPaymenController::class, 'getDDList']);
Route::get('/specialformofpayment/{special_form_of_payment}', [SpecialFormsOfPaymenController::class, 'show']);
Route::post('/specialformofpayment/{special_form_of_payment}', [SpecialFormsOfPaymenController::class, 'update']);
Route::delete('/specialformofpayment/{special_form_of_payment}', [SpecialFormsOfPaymenController::class, 'destroy']);

Route::get('/state', [StateController::class, 'index']);
Route::get('/state/ddlist', [StateController::class, 'getDDList']);
Route::get('/state/{state}', [StateController::class, 'show']);

});

// finish

// microservices para stock
//  $router->group(['middleware' => 'client.credentials'], function() use ($router)
//   {
    $router->get('/microservice/stock',  [StockServiceController::class,'index']);
    $router->get('/microservice/stock/{Stock_id}',  [StockServiceController::class,'show']);
    $router->put('/microservice/stock/{Stock_id}',  [StockServiceController::class,'update']);
    $router->delete('/microservice/stock/{Stock_id}',  [StockServiceController::class,'destroy']);
    $router->post('/microservice/stock',  [StockServiceController::class,'store']);
    // tiendaService
    $router->get('/microservice/tienda',  [TiendaServiceController::class,'index']);
    $router->post('/microservice/tienda',  [TiendaServiceController::class,'store']);
    $router->get('/microservice/tienda/{Tienda_id}',  [TiendaServiceController::class,'show']);
    $router->put('/microservice/tienda/{Tienda_id}',  [TiendaServiceController::class,'update']);
    $router->delete('/microservice/tienda/{Tienda_id}',  [TiendaServiceController::class,'destroy']);
    // productos

    $router->get('/microservice/producto',  [ProductoServiceController::class,'index']);
    $router->post('/microservice/producto',  [ProductoServiceController::class,'store']);
    $router->get('/microservice/producto/{Producto_id}',  [ProductoServiceController::class,'show']);
    $router->put('/microservice/producto/{Producto_id}',  [ProductoServiceController::class,'update']);
    $router->delete('/microservice/producto/{Producto_id}',  [ProductoServiceController::class,'destroy']);
    // proveedores
    $router->get('/microservice/proveedor',  [ProveedorServiceController::class,'index']);
    $router->post('/microservice/proveedor',  [ProveedorServiceController::class,'store']);
    $router->get('/microservice/proveedor/{Proveedor_id}',  [ProveedorServiceController::class,'show']);
    $router->put('/microservice/proveedor/{Proveedor_id}',  [ProveedorServiceController::class,'update']);
    $router->delete('/microservice/proveedor/{Proveedor_id}',  [ProveedorServiceController::class,'destroy']);

//   });
