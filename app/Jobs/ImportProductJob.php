<?php

namespace App\Jobs;

use Error;
use App\Models\Product;
use App\Models\Category;
use App\Traits\AuthUser;
use App\Models\Condition;
use App\Traits\ApiResponse;
use App\Models\PaymentMethods;
use App\Models\ProductProvider;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;



class ImportProductJob extends ImportFileJob
{
    use  AuthUser;
    use ApiResponse;

    protected function procesar($archivo, $usuario, $modelo)
    {
        $ram = memory_get_usage(true) / 1000;
        error_log("Memoria ram inicial: $ram");

        try {
            // $excel = Excel::toArray(new ProductosImport, $archivo);
            $excel = IOFactory::load($archivo);
            $sheet = $excel->getActiveSheet();
            $productosAgregados = collect();

            // Imprimir ram
            $ram = memory_get_usage(true) / 1000;
            error_log("RAM luego de cargar excel: $ram");

            $offset = 3;
            $cantidadFilas = $sheet->getHighestRow();
            $totalProductos = $cantidadFilas - $offset;

            error_log("Se cargaran $totalProductos productos");
            error_log("El excel tiene $cantidadFilas filas");

            $productosProcesados = 0;

            $contador = 4;
            for ($i = 4; $i <= $cantidadFilas; $i++) {
                try {
                    error_log($this->infoUserMe()->providerUserMe->id);
                    ($categoryValitade = Category::where('name',$sheet->getCellByColumnAndRow(3, $i)->getCalculatedValue())->first()) 
                        ?$categoryValitade 
                        :$categoryValitade = Category::create(["name" => "hola", 'description' => "ejemplo"]);
                       
                    ($condicionPago = Condition::where('condition', $sheet->getCellByColumnAndRow(7, $i)->getCalculatedValue())->first())
                        ? $condicionPago
                        : $condicionPago =  Condition::create(['condition' => $sheet->getCellByColumnAndRow(3, $i)->getCalculatedValue()]);
                        
        
                    ($metodos = PaymentMethods::where('payment_method', $sheet->getCellByColumnAndRow(14, $i)->getCalculatedValue())->first())
                    ?$metodos 
                    :$metodos = PaymentMethods::create(['payment_method' => $sheet->getCellByColumnAndRow(14, $i)->getCalculatedValue()]);

                    $product = [
                        'name' => $sheet->getCellByColumnAndRow(1, $i)->getCalculatedValue(),
                        'sku_provider' => $sheet->getCellByColumnAndRow(2, $i)->getCalculatedValue(),
                        'category' => $categoryValitade->id,
                        'bar_code' => $sheet->getCellByColumnAndRow(4, $i)->getCalculatedValue(),
                        'condition' => $sheet->getCellByColumnAndRow(5, $i)->getCalculatedValue(),
                        'drive_unit' => $sheet->getCellByColumnAndRow(6, $i)->getCalculatedValue(),
                        'payment_condition' => $condicionPago->id,
                        'currency' => $sheet->getCellByColumnAndRow(8, $i)->getCalculatedValue(),
                        'pack_quantity' => $sheet->getCellByColumnAndRow(9, $i)->getCalculatedValue(),
                        'cost_per_package' => $sheet->getCellByColumnAndRow(10, $i)->getCalculatedValue(),
                        'discount' => $sheet->getCellByColumnAndRow(11, $i)->getCalculatedValue(),
                        'cost_per_unit' => $sheet->getCellByColumnAndRow(12, $i)->getCalculatedValue(),
                        'sugessted_price' => $sheet->getCellByColumnAndRow(13, $i)->getCalculatedValue(),
                        'method_of_payment' => $metodos->id,
                        
                    ];
                    // ejemplo  para reempalzar
                    $validator = Validator::make($product, [
                        'name' => 'required',
                        'sku_provider' => 'required',
                        'category' => 'required',
                        'bar_code' => 'required',
                        'condition' => 'required',
                        'currency' => 'required',
                        'cost_per_package' => 'required',
                        // 'cost_per_unit' => 'required',
                        'sugessted_price' => 'required',
                        'method_of_payment' => 'required',
                    ]);
                    error_log($product['sku_provider']);
                    $productosAgregados->add($product);

                    // Si se pasa la validación entonces se determinara si se editara un producto y si
                    // se creara uno nuevo
                    if ($validator->fails()) {
                        error_log($validator->errors());
                    }
                    if (!$validator->fails()) {
                        $producto = Product::where('name', $product['name'])->where('sku_provider', $product['sku_provider'])->first();
                        if ($producto) {
                            $producto->update($product);
                            error_log("producto actulizado");
                            error_log($producto->id);
                            
                        } else {
                            if(is_null($this->infoUserMe()->providerUserMe))
                            {
                              return $this->errorResponse("Debe tener un proveedor registrado",400);
                            };
                            $productNew = Product::create($product);
                            error_log($productNew->name);
                            error_log("producto registrados");
                            $productprovider = ProductProvider::create([
                            'product_id' => $productNew->id,
                            'provider_id' => $this->infoUserMe()->providerUserMe->id]);
                            error_log($productprovider);
                            error_log($productprovider->id);
                            error_log("productoProvider registrado");
                        }
                    }
                    
                } catch (\Throwable $th) {
                    error_log($th);
                    throw new Error("Existe un error en la linea $contador del excel");
                    // TODO:AGREGAR UN TRY CATCH PARA CADA COLUMNA
                }

                // error_log(memory_get_usage(true));
                $contador++;
                $productosProcesados++;
                $this->informarProgreso($productosProcesados / $totalProductos);
            }

            $this->informarProgreso(0, true);
        } catch (\Throwable$e) {
            error_log($e);
            throw new Error("El formato del archivo no es valido");
        }

        // Imprimir ram antes de eliminar el excel
        $ram = memory_get_usage(true) / 1000;
        error_log("Memoria ram final: $ram");

        // Liberar ram del excel
        $excel->disconnectWorksheets();
        $excel->garbageCollect();
        unset($excel);

        // Imprimir ram despues de eliminar el excel
        $ram = memory_get_usage(true) / 1000;
        error_log("Memoria ram final: $ram");

        // $producto->pivot->actualizarFechaEdicionProductos();
    }

    protected function ruta()
    {
        return "porductosImport/{$this->modelo->id}.xlsx";
    }

    protected function respuesta()
    {
        return ["Product" => $this->modelo->id];
    }
}
