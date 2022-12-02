<?php
namespace App\Service;

use App\Traits\ConsumeExternalService;
// ojo usar esata parta para actualizar productos de woocommerce 
class ProveedorService 
{
     use ConsumeExternalService;
     public $baseUri;
     public $secret;

     public function __construct()
     {
         $this->baseUri = config('services.oasis.base_uri');
         $this->secret = config('services.oasis.secret');
     }

     public function getProveedorIndex()
     {
         error_log($this->secret);
       return  $this->performRequest('GET', '/proveedorService');
       
     }

     public function createProveedor($data)
     {
       
      return  $this->performRequest('POST', '/proveedorService', $data);
     }
     public function getProveedorShow($Proveedor_id)
     {
        return $this->performRequest('GET', "/proveedorService/{$Proveedor_id}");
     }

     public function editProveedor($data, $Proveedor_id)
     {
      return $this->performRequest('PUT', "/proveedorService/{$Proveedor_id}", $data);
     }
     public function deleteProveedor($Proveedor_id)
     {
      return $this->performRequest('DELETE', "/proveedorService/{$Proveedor_id}");
     }
}

