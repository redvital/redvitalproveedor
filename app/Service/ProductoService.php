<?php
namespace App\Service;

use App\Traits\ConsumeExternalService;
// ojo usar esata parta para actualizar productos de woocommerce 
class ProductoService 
{
     use ConsumeExternalService;
     public $baseUri;
     public $secret;

     public function __construct()
     {
         $this->baseUri = config('services.oasis.base_uri');
         $this->secret = config('services.oasis.secret');
     }

     public function getProductoIndex()
     {
         error_log($this->secret);
       return  $this->performRequest('GET', '/productService');
       
     }

     public function createProducto($data)
     {
       
      return  $this->performRequest('POST', '/productService', $data);
     }
     public function getProductoShow($Producto_id)
     {
        return $this->performRequest('GET', "/productService/{$Producto_id}");
     }

     public function editProducto($data, $Producto_id)
     {
      return $this->performRequest('PUT', "/productService/{$Producto_id}", $data);
     }
     public function deleteProducto($Producto_id)
     {
      return $this->performRequest('DELETE', "/productService/{$Producto_id}");
     }
}

