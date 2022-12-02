<?php
namespace App\Service;

use App\Traits\ConsumeExternalService;
// ojo usar esata parta para actualizar productos de woocommerce 
class TiendaService 
{
     use ConsumeExternalService;
     public $baseUri;
     public $secret;

     public function __construct()
     {
         $this->baseUri = config('services.oasis.base_uri');
         $this->secret = config('services.oasis.secret');
     }

     public function getTiendaIndex()
     {
         error_log($this->secret);
       return  $this->performRequest('GET', '/tiendaService');
       
     }

     public function createTienda($data)
     {
       
      return  $this->performRequest('POST', '/tiendaService', $data);
     }
     public function getTiendaShow($Tienda_id)
     {
        return $this->performRequest('GET', "/tiendaService/{$Tienda_id}");
     }

     public function editTienda($data, $Tienda_id)
     {
      return $this->performRequest('PUT', "/tiendaService/{$Tienda_id}", $data);
     }
     public function deleteTienda($Tienda_id)
     {
      return $this->performRequest('DELETE', "/tiendaService/{$Tienda_id}");
     }
}

