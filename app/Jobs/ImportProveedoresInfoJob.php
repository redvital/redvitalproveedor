<?php

namespace App\Jobs;

use Error;
use App\Models\Provider;
use App\Models\SupplierBankDetails;
use Illuminate\Bus\Queueable;
use App\Traits\ApiResponse;
use App\Traits\AuthUser;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;



class ImportProveedoresInfoJob extends ImportFileJob
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

            $contador = 5;
            for ($i = 5; $i <= $cantidadFilas; $i++) {
                try {
                    error_log("comienzo de la iteracion $i");
                    $provider = [
                         'name' => $sheet->getCellByColumnAndRow(1, $i)->getCalculatedValue(),
                         'email' => $sheet->getCellByColumnAndRow(2, $i)->getCalculatedValue(),
                         'phone_number' => $sheet->getCellByColumnAndRow(3, $i)->getCalculatedValue(),
                         'rif' => $sheet->getCellByColumnAndRow(4, $i)->getCalculatedValue(),
                         'company' => $sheet->getCellByColumnAndRow(5, $i)->getCalculatedValue(),
                         'provider_type' => 1,
                         'user_id' => $this->infoUserMe()->providerUserMe->id  
                    ];
                    $detallesBancarios = [
                        'bank' => $sheet->getCellByColumnAndRow(7, $i)->getCalculatedValue(),
                        'currency' => $sheet->getCellByColumnAndRow(8, $i)->getCalculatedValue(),
                        'method_of_payment' =>  $sheet->getCellByColumnAndRow(9, $i)->getCalculatedValue(),
                        'account_type' => $sheet->getCellByColumnAndRow(10, $i)->getCalculatedValue(),
                        'account_number' => $sheet->getCellByColumnAndRow(11, $i)->getCalculatedValue(),
                        'account_holder' => $sheet->getCellByColumnAndRow(12, $i)->getCalculatedValue(),
                        'rif' => $sheet->getCellByColumnAndRow(13, $i)->getCalculatedValue(),
                        'observations'=> $sheet->getCellByColumnAndRow(14, $i)->getCalculatedValue(), 
                    ];
                    $validatorIndoBank = Validator::make($detallesBancarios, [
                        'bank' => 'required',
                        'method_of_payment' => 'required',
                        'account_type' => 'required',
                        'account_number' => 'required',
                        'account_holder' => 'required',
                        'currency' => 'required',
                        'rif' => 'required',
                    ]);

                    // ejemplo  para reempalzar
                    $validator = Validator::make($provider, [
                        'name' => 'required',
                        'email' => 'required',
                        'company' => 'required',
                        'rif' => 'required',
                        'provider_type' => 'required',
                    ]);

                    $validationInfomationaAditional = [
                        
                        'fiscal_address',
                        'state',
                        'postal_code',
                        'commercial_name',
                        'payment_condition',
                        'retention',
                        'consignment',
                        'representative_id',
                        'rif',
                        'commercial_register',
                        'identification_document'
                
                    ];

                    if ($validator->fails()) {
                        error_log($validator->errors());
                    }
                    if (!$validator->fails()) {
                        $providerValidate = Provider::where('name', $provider['name'])->where('email', $provider['email'])->first();
                        if ($providerValidate) {
                            $providerValidate->update($provider);
                            error_log("producto actulizado");
                            
                        } else {
                            if(is_null($this->infoUserMe()->providerUserMe))
                            {
                              return $this->errorResponse("Debe tener un proveedor registrado",400);
                            };
                            $providerValidate = Provider::create($provider);
                            
                        }
                        // error_log($providerValidate->id);
                        
                        if ($validatorIndoBank->fails()) {
                            error_log($validator->errors());
                        }
                        if (!$validatorIndoBank->fails()) {
                            $infoBack = array_merge(
                                $detallesBancarios,
                                [   "supplier_id" => $providerValidate->id ]
                            );
                            $validateInfoBank = SupplierBankDetails::where('rif', $detallesBancarios['rif'])->where('supplier_id', $providerValidate->id)->first();
                            if ($validateInfoBank) {
                                $validateInfoBank->update($infoBack);
                                error_log("actualizado detalles bancarios");
                            } else {
                                $providerValidate = SupplierBankDetails::create($infoBack);
                                error_log("informacion bancaria agregada");
                            }
                            error_log($providerValidate);
                        }


                    }
                    
                } catch (\Throwable $th) {
                    error_log($th);
                    throw new Error("Existe un error en la linea $contador del excel");
                    // TODO:AGREGAR UN TRY CATCH PARA CADA COLUMNA
                }
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
    protected function procesarProveedor($i, $excel){
       
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


